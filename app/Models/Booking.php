<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['driver_id', 'vehicle_id', 'dateTime', 'halfDay', 'active', 'booking_status_id', 'trip_type_id','agency_id','company_id'];

    public function triptype()
    {
        return $this->belongsTo(TripType::class, 'trip_type_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    public function status()
    {
        return $this->belongsTo(BookingStatus::class, 'booking_status_id');
    }
}
