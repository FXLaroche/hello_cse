<?php

namespace Database\Seeders;

use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin::factory(10)->create();

        Admin::factory()->create([
            'name' => 'Admin1',
            'email' => 'admin1@hello.cse',
            'password' => Hash::make('password'),
        ]);
    }
}
