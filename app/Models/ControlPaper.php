<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlPaper extends Model
{
    use HasFactory;

    protected $fillable = ['type','kilometers','dateTime','observations', 'signed', 'vehicle_id'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function damages()
    {
        return $this->hasMany(Damage::class, 'control_paper_id');
    }
}
