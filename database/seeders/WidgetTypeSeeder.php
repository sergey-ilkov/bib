<?php

namespace Database\Seeders;

use App\Models\WidgetType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WidgetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        WidgetType::updateOrCreate(
            ['slug' => 'bank-statement-checker'],
            ['name' => 'Bank statement checker']
        );
    }
}
