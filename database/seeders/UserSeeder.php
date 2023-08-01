<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Group;
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
        $groups = Group::all()->loadCount('users');

        User::create([
            'staff_id' => 'TM39712',
            'email' => 'aiman@aiman.com',
            'name' => 'Muhammad Amirul Aiman bin Azhari',
            'division' => 'SRITI',
            'password' => Hash::make('password'),
            'is_committee' => true,
            'is_active' => true,
            'activated_at' => now(),
            'phone' => '0135711937',
        ])->assignRole('Admin');
    }
}
