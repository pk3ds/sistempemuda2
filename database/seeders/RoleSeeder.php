<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Admin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'Committee']);
        Role::create(['name' => 'User']);
        // TODO add more roles to control app
    }
}
