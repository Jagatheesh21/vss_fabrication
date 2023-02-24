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
        RawMaterial::Create(['category_id'=>1,'type_id'=>1,'name'=>'16.0MM','part_description'=>'16.0x1500x6300','unit_weight'=>'1186.92','uom_id'=>1]);
        RawMaterial::Create(['category_id'=>1,'type_id'=>1,'name'=>'11.6MM','part_description'=>'11.6x1500x6300','unit_weight'=>'860.517','uom_id'=>1]);
        RawMaterial::Create(['category_id'=>1,'type_id'=>1,'name'=>'10.0MM','part_description'=>'10.0x1500x1500','unit_weight'=>'176.625','uom_id'=>1]);
        RawMaterial::Create(['category_id'=>1,'type_id'=>1,'name'=>'8.0MM','part_description'=>'8.0x1500x750','unit_weight'=>'141.300','uom_id'=>1]);
        RawMaterial::Create(['category_id'=>1,'type_id'=>2,'name'=>'DIA 50','part_description'=>'DIA 50','unit_weight'=>'1.000','uom_id'=>2]);
        RawMaterial::Create(['category_id'=>1,'type_id'=>2,'name'=>'DIA 60','part_description'=>'DIA 60','unit_weight'=>'1.000','uom_id'=>2]);
    }
}
