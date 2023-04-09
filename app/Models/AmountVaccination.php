<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AmountVaccination extends Model
{
    use HasFactory;

    protected $table = "amount_vaccination";

    protected $fillable = [
        'id',
        'vaccination_name',
        'vaccination_count',
        'health_id',
    ];


    public function healthCenter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'health_id')->where('role', 'users_health_center');
    }
  
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('count');
    }


    public function vaccination_name(): BelongsTo
    {
        return $this->belongsTo(VaccinationNames::class,'vaccination_name','id');
    }
    public function getVaccinationNameTextAttribute()
    {
        return $this->vaccination_name->vaccination_name;
    }
    
    

}
