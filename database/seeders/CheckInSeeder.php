<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CheckIn;
use App\Models\Meeting;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CheckInSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $meetings = Meeting::all();
        foreach ($users as $user) {
            foreach ($meetings as $meeting) {
                CheckIn::create([
                    'user_id' => $user->id,
                    'meeting_id' => $meeting->id,
                ]);
            }
        }
    }
}
