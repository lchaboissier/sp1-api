<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Can extends Model
{
    protected $fillable = ['capacity_id', 'role_id'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function capacity()
    {
        return $this->belongsTo(Capacity::class, 'capacity_id');
    }
}
