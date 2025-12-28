<?php

namespace App\Http\Controllers;

use App\Models\CommunityHall;
use Illuminate\Http\Request;

class CommunityHallController extends Controller
{
    public function index()
    {
        $halls = CommunityHall::paginate(10);
        return view('admin.halls.index', compact('halls'));
    }

    public function userIndex(Request $request)
    {
        $search = $request->input('search');

        $halls = CommunityHall::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%");
        })->paginate(6);

        return view('user.halls.index', compact('halls', 'search'));
    }

    public function create()
    {
        return view('admin.halls.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'price_per_day' => 'required|numeric',
            'price_per_hour' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        CommunityHall::create($validated);
        return redirect()->route('admin.halls.index')->with('success', 'Hall created successfully.');
    }

    public function show(CommunityHall $hall)
    {
        $hall->load('rooms');
        return view('user.halls.show', compact('hall'));
    }

    public function edit(CommunityHall $hall)
    {
        return view('admin.halls.edit', compact('hall'));
    }

    public function update(Request $request, CommunityHall $hall)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'price_per_day' => 'required|numeric',
            'price_per_hour' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        $hall->update($validated);
        return redirect()->route('admin.halls.index')->with('success', 'Hall updated successfully.');
    }

    public function destroy(CommunityHall $hall)
    {
        $hall->delete();
        return redirect()->route('admin.halls.index')->with('success', 'Hall deleted successfully.');
    }
}
