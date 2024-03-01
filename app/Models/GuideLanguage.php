<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideLanguage extends Model
{
    use HasFactory;
    protected $fillable = [
        'guide_id',
        'language_id',
    ];
    public function tourGuide()
    {
        return $this->belongsTo(TourGuide::class, 'guide_id')->select( 'guide_name', 'city', 'phone_number', 'email', 'gender', 'age', 'price');
    }
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id')->select( 'id', 'language_name');
    }
}
