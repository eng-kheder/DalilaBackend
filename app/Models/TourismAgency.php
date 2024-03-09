<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TourismAgency extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'agency_name',
        'city',
        'phone_number',
        'email',
        'location',
        'commercial_record',
        'type_id',
        'price' ,
        'password',
        'password_confirmation' ,
        'updated_at',
        'created_at',
    ];
    protected $hidden = [
        'remember_token',
        'email_verified_at',

    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tourismAgencyType()
    {
        return $this->belongsTo(UsersType::class, 'type_id')->select('id', 'type_title');
    }
    public function agencyLanguages()
    {
        return $this->hasMany(AgencyLanguage::class, 'agency_id')->select( 'agency_id','language_id');
    }

}
