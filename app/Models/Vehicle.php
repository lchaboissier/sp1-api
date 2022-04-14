<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['matriculation','agency_id','state_id','vehicle_model_id'];

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function vehicleModel()
    {
        return $this->belongsTo(VehicleModel::class, 'vehicle_model_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'vehicle_id');
    }

    public function controlPaper()
    {
        return $this->hasOne(ControlPaper::class, 'vehicle_id');
    }
}
