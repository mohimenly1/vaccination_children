<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccinationChildAdd extends Model
{

    use HasFactory;
    protected $table = 'vaccinations';
    protected $fillable=[
        'HealthCenterId',
        'NidChild',
        'VaccinationName',
        'VaccinationDate',
        'NurseName'
    ];

    public function child()
{
    return $this->belongsTo(Child::class, 'NidChild','id');
}

public function user(){
    return $this->belongsTo(User::class,'HealthCenterId','id');
}
}
