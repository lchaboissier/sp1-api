<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'trip_type_id');
    }

}
