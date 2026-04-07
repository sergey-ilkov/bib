<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $data = ['name' => 'Bob Smith',     'email' => 'bob@bob.test',    'password' => Hash::make('securepass1234')];
        $user = User::create($data);

        if ($user) {

            $data_sites = [
                [
                    'name' => 'www',
                    'domen' => 'test.com',
                    'settings' => [
                        'file_upload_url' => 'https://bibber.com',
                        // 'data_upload_url' => 'https://bibber.com',
                        'device_script' => true,
                    ],
                    'is_blocked' => false,
                ],
                [
                    'name' => 'www 2',
                    'domen' => 'test2.com',
                    'settings' => [
                        'file_upload_url' => 'https://api.2bibber.com',
                        'device_script' => false,
                    ],
                    'is_blocked' => false,
                ],
                [
                    'name' => 'www 3',
                    'domen' => 'test3.com',
                    'settings' => [
                        'file_upload_url' => 'https://api.3bibber.com',
                        'device_script' => false,
                    ],
                    'is_blocked' => false,
                ],
            ];

            $user->sites()->createMany($data_sites);
        }
    }
}
