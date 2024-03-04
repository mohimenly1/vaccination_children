<?php

namespace App\Models;
use Geocoder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'image',
        'role',
        'active',
        'latitude',
        'longitude',
        'birth_date_parent', 
        'national_number_parent', 
        'phone_number', 
        'address', 
        'ssn'
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function notifications(): MorphMany
    {
        return $this->morphMany(DatabaseNotification::class, 'notifiable')->orderBy('created_at', 'desc');
    }


    public function respond_inquiries_as_app(): HasMany
    {
        return $this->hasMany(RespondInquiry::class, 'users_app_id');
    }

    public function respond_inquiries_as_health_center(): HasMany
    {
        return $this->hasMany(RespondInquiry::class, 'users_health_center_id');
    }

    
    public function usersHealthCenter()
    {
        return $this->belongsTo(User::class, 'users_health_center_id');
    }

    // public function amountVaccinations(): HasMany
    // {
    //     return $this->hasMany(AmountVaccination::class, 'health_id');
    // }


    public function amountVaccinations()
{
    return $this->belongsToMany(AmountVaccination::class)
                ->withPivot('count', 'health_id');
}




/**
     * Activate the user account.
     *

    * @return void
    */
   public function activate()
   {
       $this->update(['active' => true]);
   }

   /**
    * Deactivate the user account.
    *
    * @return void
    */
   public function deactivate()
   {
       $this->update(['active' => false]);
   }

   /**
    * Determine if the user account is active.
    *
    * @return bool
    */
   public function isActive()
   {
       return $this->active;
   }

}
