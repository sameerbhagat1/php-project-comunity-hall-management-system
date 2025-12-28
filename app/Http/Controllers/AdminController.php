<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityHall;
use App\Models\Room;
use App\Models\Booking;

class AdminController extends Controller
{
    public function index()
    {
        $now = now();
        $bookedHalls = CommunityHall::whereHas('bookings', function ($q) use ($now) {
            $q->where('status', '!=', 'rejected')
                ->where('start_time', '<=', $now)
                ->where('end_time', '>=', $now);
        })->count();

        $bookedRooms = Room::whereHas('bookings', function ($q) use ($now) {
            $q->where('status', '!=', 'rejected')
                ->where('start_time', '<=', $now)
                ->where('end_time', '>=', $now);
        })->count();

        $stats = [
            'halls' => CommunityHall::count(),
            'rooms' => Room::count(),
            'bookings' => Booking::count(),
            'revenue' => Booking::where('payment_status', 'paid')->sum('total_price'),
            'booked_halls' => $bookedHalls,
            'booked_rooms' => $bookedRooms,
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
