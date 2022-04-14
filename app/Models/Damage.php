<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Damage extends Model
{
    use HasFactory;

    protected $fillable = ['control_paper_id','damage_type_id','part_id'];

    public function controlPaper()
    {
        return $this->belongsTo(ControlPaper::class, 'control_paper_id');
    }

    public function damageType()
    {
        return $this->belongsTo(DamageType::class, 'damage_type_id');
    }

    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }
}
