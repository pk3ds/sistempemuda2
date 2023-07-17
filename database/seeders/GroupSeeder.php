<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'name' => 'ONEKANDA',
            'points' => 0,
        ]);
        Group::create([
            'name' => 'BLUESONIC',
            'points' => 0,
        ]);
        Group::create([
            'name' => 'TECH JEDI',
            'points' => 0,
        ]);
        Group::create([
            'name' => 'MATRIX',
            'points' => 0,
        ]);
        Group::create([
            'name' => 'THE NEON GALAXY',
            'points' => 0,
        ]);
        Group::create([
            'name' => 'SPACE INVADERS',
            'points' => 0,
        ]);
        Group::create([
            'name' => 'THE SEVENGERS',
            'points' => 0,
        ]);
        Group::create([
            'name' => 'ALARIC',
            'points' => 0,
        ]);
        Group::create([
            'name' => 'TM ONE MECHANIZE',
            'points' => 0,
        ]);
        Group::create([
            'name' => 'THE X TEAM',
            'points' => 0,
        ]);
        Group::create([
            'name' => 'MECHAMATO',
            'points' => 0,
        ]);
        Group::create([
            'name' => 'PIXEL PERFECT',
            'points' => 0,
        ]);
        Group::create([
            'name' => 'TECH BLASTER',
            'points' => 0,
        ]);
        Group::create([
            'name' => 'RED PHANTOM',
            'points' => 0,
        ]);
        Group::create([
            'name' => 'TM ONE BOLEH',
            'points' => 0,
        ]);
        Group::create([
            'name' => 'CYBORG SIXTEENERS',
            'points' => 0,
        ]);
    }
}
