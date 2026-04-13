<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';
    protected $fillable = [
        'plane_id',
        'origin_id',
        'destination_id',
        'departure_time',
        'arrival_time',
        'price',
        'available_seats'
    ];

    public function plane()
    {
        return $this->belongsTo(Plane::class);
    }

    public function origin()
    {
        return $this->belongsTo(City::class, 'origin_id');
    }

    public function destination()
    {
        return $this->belongsTo(City::class, 'destination_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
