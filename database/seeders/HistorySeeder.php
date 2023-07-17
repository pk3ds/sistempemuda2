<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Award;
use App\Models\Group;
use App\Models\History;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            $history = History::create([
                'remark' => 'User default',
                'points' => $user->points,
            ]);
            $user->histories()->save($history);
        }

        $groups = Group::all();
        foreach ($groups as $group) {
            $history = History::create([
                'remark' => 'Group default',
                'points' => $group->points,
            ]);
            $group->histories()->save($history);
        }
    }
}
