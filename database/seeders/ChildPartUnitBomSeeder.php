<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChildPartUnitBom;

class ChildPartUnitBomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChildPartUnitBom::truncate();
  
        $csvFile = fopen(base_path("database/mysql/child_part_unit_boms.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                ChildPartUnitBom::create([
                    "child_part_number_id" => $data['1'],
                    "uom_id" => $data['2'],
                    "bom" => $data['3'],
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
