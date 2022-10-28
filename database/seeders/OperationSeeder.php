<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Operation;

class OperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Operation::create(['name' => 'Store','description'=> 'Store','operation_type_id' =>1,'type' => 'IH']);
        Operation::create(['name' => 'CNC','description'=> 'CNC (chipping, grinding)','operation_type_id' =>2,'type' => 'IH']);
        Operation::create(['name' => 'TubeCutting','description'=> 'TubeCutting','operation_type_id' =>2,'type' => 'OS']);
        Operation::create(['name' => 'Bending','description'=> 'Bending','operation_type_id' =>2,'type' => 'IH']);
        Operation::create(['name' => 'Flange Boring','description'=> 'Flange Boring','operation_type_id' =>2,'type' => 'OS']);
        Operation::create(['name' => 'Bracket boring','description'=> 'Bracket boring','operation_type_id' =>2,'type' => 'OS']);
        Operation::create(['name' => 'Block Machining','description'=> 'Block Machining','operation_type_id' =>2,'type' => 'OS']);
        Operation::create(['name' => 'Bending','description'=> 'Bending','operation_type_id' =>2,'type' => 'IH']);
        Operation::create(['name' => 'Relief Cutting','description'=> 'Relief Cutting','operation_type_id' =>2,'type' => 'IH']);
        Operation::create(['name' => 'Tube Cutting & Machining','description'=> 'Tube Cutting & Machining','operation_type_id' =>2,'type' => 'OS']);
        Operation::create(['name' => 'Block Machining','description'=> 'Block Machining','operation_type_id' =>2,'type' => 'OS']);

    }
}
