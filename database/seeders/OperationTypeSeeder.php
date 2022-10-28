<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OperationType;

class OperationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OperationType::create([
            'name' => 'Stocking Point',
        ]);
        OperationType::create([
            'name' => 'Operations',
        ]);
    }
}
