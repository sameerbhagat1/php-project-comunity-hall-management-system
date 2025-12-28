<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommunityHallController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $now = now();
        $bookedHalls = \App\Models\CommunityHall::whereHas('bookings', function ($q) use ($now) {
            $q->where('status', '!=', 'rejected')
                ->where('start_time', '<=', $now)
                ->where('end_time', '>=', $now);
        })->count();

        $bookedRooms = \App\Models\Room::whereHas('bookings', function ($q) use ($now) {
            $q->where('status', '!=', 'rejected')
                ->where('start_time', '<=', $now)
                ->where('end_time', '>=', $now);
        })->count();

        $stats = [
            'total_halls' => \App\Models\CommunityHall::count(),
            'total_rooms' => \App\Models\Room::count(),
            'booked_halls' => $bookedHalls,
            'booked_rooms' => $bookedRooms,
            'available_halls' => \App\Models\CommunityHall::count() - $bookedHalls,
            'available_rooms' => \App\Models\Room::count() - $bookedRooms,
            'my_bookings' => auth()->user()->bookings()->count(),
        ];

        $recent_bookings = auth()->user()->bookings()->with('bookable')->where('end_time', '>=', $now)->orderBy('start_time', 'asc')->limit(5)->get();

        return view('dashboard', compact('stats', 'recent_bookings'));
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('halls', CommunityHallController::class);
        Route::resource('rooms', RoomController::class);
        Route::resource('bookings', BookingController::class);
        Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.update-status');
    });

    // User specific routes
    Route::middleware(['role:user'])->group(function () {
        Route::get('/halls', [CommunityHallController::class, 'userIndex'])->name('user.halls.index');
        Route::get('/halls/{hall}', [CommunityHallController::class, 'show'])->name('user.halls.show');
        Route::get('/rooms', [RoomController::class, 'userIndex'])->name('user.rooms.index');
        Route::get('/my-bookings', [BookingController::class, 'userBookings'])->name('user.bookings.index');
        Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    });
});

require __DIR__ . '/auth.php';
