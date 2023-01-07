<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PartTypeSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            TypeSeeder::class,
            RawMaterialSeeder::class,
            OperationTypeSeeder::class,
            OperationSeeder::class,
            UomSeeder::class,
            ChildPartNumberSeeder::class,
            AssemblePartNumberSeeder::class,
            NestingSeeder::class
        ]);
    }
}
