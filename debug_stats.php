<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Current Time (App): " . now() . "\n";
echo "Current Time (PHP): " . date('Y-m-d H:i:s') . "\n";
echo "Total Halls: " . \App\Models\CommunityHall::count() . "\n";

$bookedHalls = \App\Models\CommunityHall::whereHas('bookings', function ($q) {
    $now = now();
    $q->where('status', '!=', 'rejected')
        ->where('start_time', '<=', $now)
        ->where('end_time', '>=', $now);
})->count();

echo "Booked Halls (Query Logic): " . $bookedHalls . "\n";

$allBookings = \App\Models\Booking::all();
echo "\nDetailed Bookings Status:\n";
foreach ($allBookings as $b) {
    echo "ID: {$b->id}, Type: {$b->bookable_type}, Start: {$b->start_time}, End: {$b->end_time}, Status: {$b->status}\n";
}
