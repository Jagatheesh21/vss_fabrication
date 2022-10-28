<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Uom;

class UomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Uom::create(
            ['name' => 'kg','display_name' => 'kilogram'],
        );
        Uom::create(
            ['name' => 'nos','display_name' => 'Numbers'],
        );
        Uom::create(
            ['name' => 'mtr','display_name' => 'Meter'],
        );
    }
}
