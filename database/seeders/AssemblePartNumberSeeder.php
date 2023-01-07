<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AssemblePartNumber;

class AssemblePartNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssemblePartNumber::truncate();
  
        $csvFile = fopen(base_path("database/mysql/assemble_part_numbers.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                AssemblePartNumber::create([
                    "part_type_id" => $data['1'],
                    "name" => $data['2'],
                    "project_name" => $data['3'],
                    "revision_number" => $data['4'],
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);

    }
}
