<?php

namespace Tests;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RoleTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->make();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateSuccess()
    {
        $permission = factory(Permission::class)->create();

        $input = factory(Role::class)->make(['permission_ids' => [$permission->id]])->toArray();

        $this->actingAs($this->user)
            ->visit('settings/roles/create')
            ->submitForm('Save', $input)
            ->see('Role created!')
            ->seePageIs('settings/roles');
    }

    public function testRequiredPermission()
    {
        $input = factory(Role::class)->make()->toArray();

        $this->actingAs($this->user)
            ->visit('settings/roles/create')
            ->submitForm('Save', $input)
            ->see('The permissions field is required.')
            ->seePageIs('settings/roles/create');
    }

    public function testCreateDuplicateRoleName()
    {
        factory(Role::class)->create(['name' => 'Role Testing']);

        $input = factory(Role::class)->make([
            'name' => 'Role Testing',
        ])->toArray();

        $this->actingAs($this->user)
            ->visit('settings/roles/create')
            ->submitForm('Save', $input)
            ->see('The name has already been taken.')
            ->seePageIs('settings/roles/create');
    }

    public function testEditDataAvailable()
    {
        factory(Role::class)->create();

        $this->actingAs($this->user)
            ->visit('settings/roles/1/edit')
            ->see('Roles - Edit');
    }

    public function testEditDataNotFound()
    {
        $this->actingAs($this->user)
            ->get('settings/roles/1/edit')
            ->assertResponseStatus(404);
    }

    public function testUpdateSuccess()
    {
        factory(Role::class)->create(['name' => 'Role Tests']);

        $permission = factory(Permission::class)->create();

        $input = factory(Role::class)->make(['permission_ids' => [$permission->id]])->toArray();

        $this->actingAs($this->user)
            ->visit('settings/roles/1/edit')
            ->submitForm('Update', $input)
            ->see('Role updated!')
            ->seePageIs('settings/roles');
    }

    public function testDeleteSuccess()
    {
        factory(Role::class)->create(['name' => 'Role Tests']);

        $this->actingAs($this->user)
            ->visit('settings/roles')
            ->submitForm('Delete')
            ->see('Role deleted!')
            ->seePageIs('settings/roles');
    }
}
