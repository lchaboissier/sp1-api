<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class, 'company_id');
    }

    public function drivers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Driver::class, 'company_id');
    }
}
