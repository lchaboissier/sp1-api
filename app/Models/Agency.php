<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = ['id','city','departmentNumber'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
