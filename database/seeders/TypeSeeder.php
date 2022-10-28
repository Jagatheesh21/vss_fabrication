<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create(['category_id'=> 1,'name' => 'RM Sheets']);
        Type::create(['category_id'=> 1,'name' => 'Tube']);
        Type::create(['category_id'=> 1,'name' => 'Forged Block']);
        Type::create(['category_id'=> 1,'name' => 'Bright Bar']);
        Type::create(['category_id'=> 2,'name' => 'Flange']);
        Type::create(['category_id'=> 2,'name' => 'Bracket']);
        Type::create(['category_id'=> 2,'name' => 'Support Plate']);
        Type::create(['category_id'=> 2,'name' => 'Tube']);
        Type::create(['category_id'=> 2,'name' => 'Block']);
    }
}
