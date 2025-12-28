<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CommunityHall;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $bookings = Booking::with(['user', 'bookable'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHasMorph('bookable', [CommunityHall::class, Room::class], function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('admin.bookings.index', compact('bookings', 'search'));
    }

    public function userBookings()
    {
        $bookings = auth()->user()->bookings()->with('bookable')->latest()->paginate(10);
        return view('user.bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bookable_type' => 'required|string|in:App\Models\CommunityHall,App\Models\Room',
            'bookable_id' => 'required|integer',
            'start_time' => 'required|date|after_or_equal:today',
            'end_time' => 'required|date|after:start_time',
        ]);

        $start = Carbon::parse($validated['start_time']);
        $end = Carbon::parse($validated['end_time']);

        // Check availability
        $exists = Booking::where('bookable_type', $validated['bookable_type'])
            ->where('bookable_id', $validated['bookable_id'])
            ->where(function ($query) use ($start, $end) {
                $query->where(function ($q) use ($start, $end) {
                    $q->where('start_time', '<', $end)
                        ->where('end_time', '>', $start);
                });
            })
            ->where('status', '!=', 'rejected')
            ->exists();

        if ($exists) {
            return back()->withErrors(['message' => 'Selected time slot is not available.']);
        }

        // Calculate price
        $model = $validated['bookable_type']::findOrFail($validated['bookable_id']);
        $days = $start->diffInDays($end);
        $hours = $start->diffInHours($end) % 24;

        $total_price = 0;
        // Pricing logic: if per hour is set, use it for short duration. 
        // If > 1 day, use day rate.

        if ($days >= 1) {
            $total_price += $days * $model->price_per_day;
            if ($hours > 0) {
                $hourly_rate = $model->price_per_hour ?? ($model->price_per_day / 24);
                $total_price += $hours * $hourly_rate;
            }
        } else {
            // Less than a day
            $hourly_rate = $model->price_per_hour ?? ($model->price_per_day / 24);
            $total_h = $start->diffInHours($end);
            if ($total_h == 0)
                $total_h = 1; // Minimum 1 hour
            $total_price += $total_h * $hourly_rate;
        }

        Booking::create([
            'user_id' => auth()->id(),
            'bookable_type' => $validated['bookable_type'],
            'bookable_id' => $validated['bookable_id'],
            'start_time' => $start,
            'end_time' => $end,
            'total_price' => $total_price,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        return redirect()->route('user.bookings.index')->with('success', 'Booking requested successfully.');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected,paid,cancelled',
        ]);

        $booking->update([
            'status' => $validated['status'],
        ]);

        if ($validated['status'] === 'paid') {
            $booking->update(['payment_status' => 'paid']);
        }

        return back()->with('success', 'Booking status updated.');
    }
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return back()->with('success', 'Booking deleted successfully.');
    }
}
