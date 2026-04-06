<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $data = ['name' => 'Bob Smith',     'email' => 'bob@bob.test',    'password' => 'securepass1234'];
        $user = User::create($data);

        if ($user) {

            $data_sites = [
                [
                    'name' => 'www',
                    'domen' => 'test.com',
                    'upload_url' => 'https://bibber.com',
                    'device_script' => true,
                ],
                [
                    'name' => 'www 2',
                    'domen' => 'test2.com',
                    'upload_url' => 'https://bibber.com',

                ],
            ];

            $user->sites()->createMany($data_sites);
        }
    }
}