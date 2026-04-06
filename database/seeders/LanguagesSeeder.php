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
        $langs = [
            ['name' => 'English', 'code' => 'en',],
            ['name' => 'Spanish', 'code' => 'es',],
        ];

        foreach ($langs as $lang) {

            // $data = [
            //     'name' => $lang['name'],
            //     'code' => $lang['code'],
            // ];

            // Language::сreate($data);
            Language::updateOrCreate(['code' => $lang['code']], $lang);
        }
    }
}
