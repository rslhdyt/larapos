<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoleTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(App\User::class)->make();
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateSuccess()
    {
        $input = factory(App\Role::class)->make()->toArray();

        $this->actingAs($this->user)
            ->visit('settings/roles/create')
            ->submitForm('Save', $input)
            ->see('Role created!')
            ->seePageIs('settings/roles');
    }

    public function testCreateDuplicateRoleName()
    {
        factory(App\Role::class)->create(['name' => 'Role Testing']);

        $input = factory(App\Role::class)->make([
            'name' => 'Role Testing'
        ])->toArray();

        $this->actingAs($this->user)
            ->visit('settings/roles/create')
            ->submitForm('Save', $input)
            ->see('The name has already been taken.')
            ->seePageIs('settings/roles/create');
    }

    public function testEditDataAvailable()
    {
        factory(App\Role::class)->create();

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
        factory(App\Role::class)->create(['name' => 'Role Tests']);

        $input = factory(App\Role::class)->make()->toArray();

        $this->actingAs($this->user)
            ->visit('settings/roles/1/edit')
            ->submitForm('Update', $input)
            ->see('Role updated!')
            ->seePageIs('settings/roles');
    }

    public function testDeleteSuccess()
    {
        factory(App\Role::class)->create(['name' => 'Role Tests']);

        $this->actingAs($this->user)
            ->visit('settings/roles')
            ->submitForm('Delete')
            ->see('Role deleted!')
            ->seePageIs('settings/roles');
    }
}
