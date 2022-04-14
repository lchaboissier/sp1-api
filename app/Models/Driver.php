<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = ['id','firstName','lastName','street','postalCode','city','mail','phoneNumber','drivingLicense','company_id'];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'driver_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
