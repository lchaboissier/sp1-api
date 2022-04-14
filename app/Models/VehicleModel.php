<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = ['name','seats','brand_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'vehicle_model_id');
    }
}
