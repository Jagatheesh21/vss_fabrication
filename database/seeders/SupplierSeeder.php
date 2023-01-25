<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;
class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create([
            'code' => 'BD15',
            'company_name' => 'BRAKES INDIA PRIVATE LIMITED',
            'gst_number' => '33AAACB2533Q1ZP',
            'address' => 'MIDRANGECOMPONENTS 42, MELVENKATAPURAM VILLAGE,PERUNKANCHI POST,SHOLINGHUR-631102, TAMILNADU',
            'pin_code' => '631102',
            'state' => 'TAMILNADU',
            'state_code' => '33',
            'contact_person' => 'MANAGER',
            'status' => 1,
        ]);
    }
}
