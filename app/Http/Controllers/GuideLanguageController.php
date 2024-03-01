<?php

namespace App\Http\Controllers;

use App\Models\GuideLanguage;

class GuideLanguageController extends Controller
{
    public function store($guide_id, $language_id)
    {
        $guideLanguage = GuideLanguage::create([
            'guide_id' => $guide_id,
            'language_id' => $language_id,

        ]);
    }

}
