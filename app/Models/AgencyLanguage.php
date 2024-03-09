<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyLanguage extends Model
{
    use HasFactory;
    protected $fillable = [
        'agency_id',
        'language_id',
    ];
    public function tourismAgency()
    {
        return $this->belongsTo(TourismAgency::class, 'agency_id')->select( 'agency_name', 'city', 'phone_number', 'email', 'location', 'commercial_record', 'price');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id')->select( 'id', 'language_name');
    }
}
