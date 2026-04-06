<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $email = $faker->unique()->safeEmail;
            $rawPassword = $faker->regexify('[A-Za-z0-9!@#\$%\^&\*]{12,}'); // min 12 chars

            User::create([
                'name' => $faker->name,
                'email' => $email,
                'password' => Hash::make($rawPassword),
            ]);
        }
    }
}