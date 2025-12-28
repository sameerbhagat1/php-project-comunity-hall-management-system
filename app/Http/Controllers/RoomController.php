<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\CommunityHall;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('communityHall')->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function userIndex(Request $request)
    {
        $search = $request->input('search');

        $rooms = Room::with('communityHall')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhereHas('communityHall', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('location', 'like', "%{$search}%");
                    });
            })->paginate(8);

        return view('user.rooms.index', compact('rooms', 'search'));
    }

    public function create()
    {
        $halls = CommunityHall::all();
        return view('admin.rooms.create', compact('halls'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'community_hall_id' => 'required|exists:community_halls,id',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'price_per_day' => 'required|numeric',
            'price_per_hour' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        Room::create($validated);
        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully.');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        $halls = CommunityHall::all();
        return view('admin.rooms.edit', compact('room', 'halls'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'community_hall_id' => 'required|exists:community_halls,id',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'price_per_day' => 'required|numeric',
            'price_per_hour' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        $room->update($validated);
        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully.');
    }
}
