<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'username' => 'pendakwah92',
            'email' => 'aiman@aiman.com',
            'name' => 'Muhammad Amirul Aiman bin Azhari',
            'password' => Hash::make('password'),
            'is_committee' => true,
            'is_active' => true,
            'activated_at' => now(),
            'phone' => '0135711937',
        ])->assignRole('Admin');
    }
}
