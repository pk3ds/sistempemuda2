<?php

namespace Database\Seeders;

use App\Models\Meeting;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meeting::create([
            'uuid' => Str::uuid()->toString(),
            'name' => 'Session 01',
            'start_at' => strtotime('17 Jan 2023 0845 -8hours'),
            'end_at' => strtotime('17 Jan 2023 1230 -8hours'),
        ]);
        Meeting::create([
            'uuid' => Str::uuid()->toString(),
            'name' => 'Session 02',
            'start_at' => strtotime('17 Jan 2023 1400 -8hours'),
            'end_at' => strtotime('17 Jan 2023 1615 -8hours'),
        ]);
        Meeting::create([
            'uuid' => Str::uuid()->toString(),
            'name' => 'Session 03',
            'start_at' => strtotime('17 Jan 2023 1645 -8hours'),
            'end_at' => strtotime('17 Jan 2023 1830 -8hours'),
        ]);
        Meeting::create([
            'uuid' => Str::uuid()->toString(),
            'name' => 'Session 04',
            'start_at' => strtotime('17 Jan 2023 2000 -8hours'),
            'end_at' => strtotime('17 Jan 2023 2300 -8hours'),
        ]);
        Meeting::create([
            'uuid' => Str::uuid()->toString(),
            'name' => 'Session 05',
            'start_at' => strtotime('18 Jan 2023 0830 -8hours'),
            'end_at' => strtotime('18 Jan 2023 1300 -8hours'),
        ]);
    }
}
