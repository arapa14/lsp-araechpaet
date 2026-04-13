<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'name',
        'logo',
        'no'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
