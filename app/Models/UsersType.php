<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersType extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_title',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'type_id')->select(    'user_name', 'city', 'phone_number', 'email', 'gender', 'age');
    }
    public function tourGuides()
    {
        return $this->hasMany(TourGuide::class, 'type_id')->select( 'guide_name', 'city', 'phone_number', 'email', 'gender', 'age', 'price');
    }

}
