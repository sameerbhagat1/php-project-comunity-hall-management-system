<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\Booking;

class CommunityHall extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'location', 'description', 'capacity', 'price_per_day', 'price_per_hour'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }

    public function isAvailable($start = null, $end = null)
    {
        $start = $start ?? now();
        $end = $end ?? now()->addHour();

        return !$this->bookings()
            ->where('status', '!=', 'rejected')
            ->where(function ($query) use ($start, $end) {
                $query->where('start_time', '<', $end)
                    ->where('end_time', '>', $start);
            })->exists();
    }

    public function getCurrentBookingAttribute()
    {
        return $this->bookings()
            ->where('status', 'approved')
            ->where('start_time', '<=', now())
            ->where('end_time', '>=', now())
            ->first();
    }
}
