<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $fillable = [
        'language_name',
    ];
    protected $hidden =['created_at' , 'updated_at'];

    public function guideLanguages()
    {
        return $this->hasMany(GuideLanguage::class, 'language_id');
    }
}
