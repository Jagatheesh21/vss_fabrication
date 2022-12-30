<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nesting;
class NestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nesting::create(['name'=>'Nesting-1']);
        Nesting::create(['name'=>'Nesting-2']);
        Nesting::create(['name'=>'Nesting-3']);
        Nesting::create(['name'=>'Nesting-4']);
        Nesting::create(['name'=>'Nesting-5']);
        Nesting::create(['name'=>'Nesting-6']);
        Nesting::create(['name'=>'Nesting-7']);
    }
}
