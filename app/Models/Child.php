<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
  
    use HasFactory;

    protected $fillable = [
        'name_child',
        'date_birth',
        'national_number',
        'last_vaccination',
        'next_vaccination',
        'health_id'
    ];

    public function vaccinations()
{
    return $this->hasMany(VaccinationChildAdd::class,'NidChild','id');
}

public function healthCenter()
{
    return $this->belongsTo(User::class, 'health_id');
}
}
