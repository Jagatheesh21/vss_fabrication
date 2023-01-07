<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RawMaterial;
class RawMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RawMaterial::Create(['category_id'=>1,'type_id'=>1,'name'=>'16.0MM','part_description'=>'16.0x1500x6300']);
        RawMaterial::Create(['category_id'=>1,'type_id'=>1,'name'=>'11.6MM','part_description'=>'11.6x1500x6300']);
        RawMaterial::Create(['category_id'=>1,'type_id'=>1,'name'=>'10.0MM','part_description'=>'10.0x1500x1500']);
        RawMaterial::Create(['category_id'=>1,'type_id'=>1,'name'=>'8.0MM','part_description'=>'8.0x1500x750']);
        RawMaterial::Create(['category_id'=>1,'type_id'=>2,'name'=>'DIA 50','part_description'=>'DIA 50']);
        RawMaterial::Create(['category_id'=>1,'type_id'=>2,'name'=>'DIA 60','part_description'=>'DIA 60']);
    }
}
