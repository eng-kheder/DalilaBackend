<?php

namespace Database\Seeders;

use App\Models\UsersType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $UserType1 = UsersType::create([
            'type_title' => 'user',
        ]);
        $UserType2 = UsersType::create([
            'type_title' => 'guide',
        ]);
        $UserType3 = UsersType::create([
            'type_title' => 'agency',
        ]);

    }
}
