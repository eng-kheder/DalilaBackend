<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rates extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'request_id',
        'description',
        'value',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->select('name', 'email', 'password', 'password_confirmation' , 'city', 'phone_number', 'gender_user', 'age_user', 'type_id');
    }
    public function request()
    {
        return $this->hasOne(Requests::class, 'request_id');
    }

}
