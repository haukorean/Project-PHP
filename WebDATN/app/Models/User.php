<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
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



    public function patient(): HasOne
    {
        return $this->hasOne(infor_patient::class, 'id_user', 'id');
    }

    public function doctor(): HasOne
    {
        return $this->hasOne(infor_doctor::class, 'id_user', 'id');
    }

    public function company(): HasOne
    {
        return $this->hasOne(company_doctor::class, 'id_user', 'id');
    }


    public function schedule_user(): HasMany
    {
        return $this->hasMany(schedule::class, 'id_user', 'id');
    }

    public function schedule_doctor(): HasMany
    {
        return $this->hasMany(schedule::class, 'id_doctor', 'id');
    }

    public function handbook(): HasMany
    {
        return $this->hasMany(handbook::class, 'id_doctor', 'id');
    }
}
