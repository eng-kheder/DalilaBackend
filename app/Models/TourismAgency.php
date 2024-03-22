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
        'name',
        'email',
        'password',
        'password_confirmation' ,
        'city',
        'phone_number',
        'location_agency',
        'commercial_record_agency',
        'type_id',
        'price_agency' ,
        'language_agency' ,
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
    public function agencyRequests()
    {
        return $this->hasMany(Requests::class, 'agency_id')->select('id', 'user_id', 'status', 'guide_id', 'agency_id', 'request_date','created_at');
    }
    public function agencyReports()
    {
        return $this->hasMany(Reports::class, 'agency_id')->select('id', 'user_id', 'description', 'agency_id', 'guide_id');
    }

//// format for created_at and updated_at
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }
    public function getUpdatedAtFormattedAttribute()
    {
        return $this->updated_at->format('Y-m-d');
    }

}
