<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $languages = [
            [
                'name' => 'English',
                'code' => 'en',
            ],
            [
                'name' => 'Spanish',
                'code' => 'es',
            ],
        ];

        foreach ($languages as $language) {
            $data = [
                'name' => $language['name'],
                'code' => $language['code'],
            ];


            Language::create($data);
        }
    }
}