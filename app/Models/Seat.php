<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $table = 'seats';
    protected $fillable = [
        'plane_id',
        'seat_number',
    ];

    public function plane()
    {
        return $this->belongsTo(Plane::class);
    }
}
