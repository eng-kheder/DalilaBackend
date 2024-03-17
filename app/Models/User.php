<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'password_confirmation' ,
        'city',
        'phone_number',
        'gender_user',
        'age_user',
        'type_id',
    ];


    protected $hidden = [
        'remember_token',
        'email_verified_at',

    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function userType()
    {
        return $this->belongsTo(UsersType::class, 'type_id')->select('id', 'type_title');
    }
    public function userRequests()
    {
        return $this->hasMany(Requests::class, 'user_id')->select('id', 'user_id', 'status', 'guide_id', 'agency_id', 'request_date');
    }
    public function userReports()
    {
        return $this->hasMany(Reports::class, 'user_id')->select('id', 'user_id', 'description', 'agency_id', 'guide_id');
    }
    public function userRates()
    {
        return $this->hasMany(Rates::class, 'user_id')->select('id', 'user_id', 'request_id', 'description', 'value');
    }


}
