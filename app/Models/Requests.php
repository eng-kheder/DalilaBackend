<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'status',
        'guide_id',
        'agency_id',
        'request_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->select('name', 'email', 'password', 'password_confirmation' , 'city', 'phone_number', 'gender_user', 'age_user', 'type_id');
    }
    public function guide()
    {
        return $this->belongsTo(TourGuide::class, 'guide_id')->select( 'name', 'email', 'password', 'password_confirmation' , 'city', 'phone_number', 'gender_guide', 'age_guide', 'price_guide', 'type_id', 'language_guide' );
    }
    public function agency()
    {
        return $this->belongsTo(TourismAgency::class, 'agency_id')->select('name', 'email', 'password', 'password_confirmation' , 'city', 'phone_number', 'location_agency', 'commercial_record_agency', 'type_id', 'price_agency' , 'language_agency'  );
    }
    public function rate()
    {
        return $this->hasOne(Rates::class, 'request_id')->select('id','user_id', 'request_id', 'description', 'value');
    }


}
