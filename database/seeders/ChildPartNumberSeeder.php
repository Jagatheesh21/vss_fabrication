<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChildPartNumber;

class ChildPartNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChildPartNumber::truncate();
  
        $csvFile = fopen(base_path("database/data/country.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Country::create([
                    "name" => $data['0'],
                    "code" => $data['1']
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
//         ChildPartNumber::create(["name"=>"29191612-03"]);
// ChildPartNumber::create(["name"=>"29194537-05"]);
// ChildPartNumber::create(["name"=>"29192957 - 08"]);
// ChildPartNumber::create(["name"=>"2919 1026 -08"]);
// ChildPartNumber::create(["name"=>"29196568 - 01"]);
// ChildPartNumber::create(["name"=>"29190910-09"]);
// ChildPartNumber::create(["name"=>"29500386/7-03"]);
// ChildPartNumber::create(["name"=>"29500466/7-03"]);
// ChildPartNumber::create(["name"=>"29500958/9-01"]);
// ChildPartNumber::create(["name"=>"29500476/7-02"]);
// ChildPartNumber::create(["name"=>"29500831/2-05"]);
// ChildPartNumber::create(["name"=>"29500851/2-04"]);
// ChildPartNumber::create(["name"=>"29196265/6-01"]);
// ChildPartNumber::create(["name"=>"29198339/40-01"]);
// ChildPartNumber::create(["name"=>"29198486/87-01"]);
// ChildPartNumber::create(["name"=>"29191312/13-01"]);
// ChildPartNumber::create(["name"=>"29500585/6 - 06"]);
// ChildPartNumber::create(["name"=>"2950 0708/9 - 03"]);
// ChildPartNumber::create(["name"=>"2950 0858/9 - 04"]);
// ChildPartNumber::create(["name"=>"2950 0682/3 - 03"]);
// ChildPartNumber::create(["name"=>"29501067-01"]);
// ChildPartNumber::create(["name"=>"29501118/ 9 - 01"]);
// ChildPartNumber::create(["name"=>"29501202/13 - "]);
// ChildPartNumber::create(["name"=>"29501441-42-01"]);
// ChildPartNumber::create(["name"=>"29195052/53-04"]);
// ChildPartNumber::create(["name"=>"29500696/7-03"]);
// ChildPartNumber::create(["name"=>"29500807 / 8 - 04"]);
// ChildPartNumber::create(["name"=>"29501135/36-02"]);
// ChildPartNumber::create(["name"=>"29196584/5-01"]);
// ChildPartNumber::create(["name"=>"29198539/40 - 01"]);
// ChildPartNumber::create(["name"=>"29194713-04"]);
// ChildPartNumber::create(["name"=>"29192115 - 03"]);
// ChildPartNumber::create(["name"=>"2919 3880 - 04"]);
// ChildPartNumber::create(["name"=>"29195322-02"]);
// ChildPartNumber::create(["name"=>"29198560-01"]);
// ChildPartNumber::create(["name"=>"29195515-03"]);
// ChildPartNumber::create(["name"=>"29196926-01"]);
// ChildPartNumber::create(["name"=>"29193881-03"]);
// ChildPartNumber::create(["name"=>"29195459-02"]);
// ChildPartNumber::create(["name"=>"29196526-01"]);
// ChildPartNumber::create(["name"=>"29192116 - 04"]);
// ChildPartNumber::create(["name"=>"29194691-02"]);
// ChildPartNumber::create(["name"=>"29194682 - 03"]);
// ChildPartNumber::create(["name"=>"29191611-10"]);
// ChildPartNumber::create(["name"=>"29192180-04"]);
// ChildPartNumber::create(["name"=>"29194665-06"]);
// ChildPartNumber::create(["name"=>"29194620-05"]);
// ChildPartNumber::create(["name"=>"29196249-01"]);
// ChildPartNumber::create(["name"=>"29195948-03"]);
// ChildPartNumber::create(["name"=>"29192990 - 07"]);
// ChildPartNumber::create(["name"=>"29194594-04"]);
// ChildPartNumber::create(["name"=>"2919 5827 - 05"]);
// ChildPartNumber::create(["name"=>"2919 5860 - 03"]);
// ChildPartNumber::create(["name"=>"29196549 - 02"]);
// ChildPartNumber::create(["name"=>"29194076-"]);
// ChildPartNumber::create(["name"=>"29196603-03"]);
// ChildPartNumber::create(["name"=>"29194553 - 02"]);
// ChildPartNumber::create(["name"=>"29196631-05"]);
// ChildPartNumber::create(["name"=>"29195395-04"]);
// ChildPartNumber::create(["name"=>"29197447-02"]);
// ChildPartNumber::create(["name"=>"29195327-05"]);
// ChildPartNumber::create(["name"=>"29195248 - 04"]);
// ChildPartNumber::create(["name"=>"29198550"]);
// ChildPartNumber::create(["name"=>"29196250-01"]);
// ChildPartNumber::create(["name"=>"29196624-02"]);
// ChildPartNumber::create(["name"=>"29198168-01"]);
    }
}


