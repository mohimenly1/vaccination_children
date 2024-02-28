<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccinationNames extends Model
{
    use HasFactory;

    protected $table = 'vaccination_names';

    protected $fillable = [
        'id',
        'vaccination_name'
    ];

    public function amount_vaccinations()
{
    return $this->hasMany(AmountVaccination::class, 'vaccination_name', 'id');
}

}
