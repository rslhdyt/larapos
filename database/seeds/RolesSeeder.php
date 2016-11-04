<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        $role = Role::create([
            'name'        => 'Administrator',
            'description' => 'Role for administrator',
        ]);

        $permissions = Permission::take(10)->get();
        $permission_ids = $permissions->pluck('id')->toArray();

        $role->permissions()->attach($permission_ids);
    }
}
