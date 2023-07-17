<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use App\Models\Award;
use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $groups = Group::all();
        $users = User::all();

        for ($index = 1; $index <= 30; $index++) {
            $groups->random()->awards()->save(
                Award::create([
                    'name' => ucwords($faker->catchPhrase()) . ' Award',
                    'points' => rand(),
                ])
            );
            $users->random()->awards()->save(
                Award::create([
                    'name' => ucwords($faker->catchPhrase()) . ' Award',
                    'points' => rand(),
                ])
            );
        }
    }
}
