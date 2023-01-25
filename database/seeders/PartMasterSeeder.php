<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PartMaster;

class PartMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PartMaster::truncate();
  
        $csvFile = fopen(base_path("database/mysql/part_masters.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                PartMaster::create([
                    "category_id" => $data['1'],
                    "type_id" => $data['2'],
                    "child_part_id" => $data['3'],
                    "uom_id" => 1,
                    "status" => 1,
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
