<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RouteCardType;

class RouteCardTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

        public function run()
        {
            RouteCardType::create(['name' => 'A']);
            RouteCardType::create(['name' => 'B']);
            RouteCardType::create(['name' => 'C']);
            RouteCardType::create(['name' => 'E']);
            RouteCardType::create(['name' => 'F']);
            RouteCardType::create(['name' => 'G']);
            RouteCardType::create(['name' => 'H']);
    
        }
    
}
