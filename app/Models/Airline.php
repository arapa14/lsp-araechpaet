<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    protected $table = 'airlines';
    protected $fillable = [
        'name',
        'code',
        'logo',
        'country'
    ];

    public function planes()
    {
        return $this->hasMany(Plane::class);
    }
}
