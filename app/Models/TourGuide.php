<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TourGuide extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'guide_name',
        'city',
        'phone_number',
        'email',
        'gender',
        'age',
        'price',
        'updated_at',
        'created_at',
        'type_id',
        'password',
        'password_confirmation' ,
    ];

    protected $hidden = [
        'remember_token',
        'email_verified_at',

    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tourGuideType()
    {
        return $this->belongsTo(UsersType::class, 'type_id')->select('id', 'type_title');
    }
    public function guideLanguages()
    {
        return $this->hasMany(GuideLanguage::class, 'guide_id')->select( 'guide_id','language_id');
    }
}
