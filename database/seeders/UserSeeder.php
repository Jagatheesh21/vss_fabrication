<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admiministrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin@123'),
        ]);
        User::create([
            'name' => 'Fabrication',
            'email' => 'vssiplunit2@gmail.com',
            'password' => bcrypt('fab@1234'),
        ]);
    }
}
