<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    public function run(): void
    {

        $this->call([

            UsersSeeder::class,
            UserSitesSeeder::class,

            LanguagesSeeder::class,
            WidgetTypeSeeder::class,
            WidgetTemplateSeeder::class,
        ]);
    }
}
