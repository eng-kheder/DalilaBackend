<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lanuage1 = Language::create([
            'language_name' => 'arabic',
        ]);
        $lanuage2 = Language::create([
            'language_name' => 'english',
        ]);
    }
}
