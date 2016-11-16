<?php

namespace Tests;

use App\Permission;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PermissionTest extends TestCase
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
        $input = factory(Permission::class)->make()->toArray();

        $this->actingAs($this->user)
            ->visit('settings/permissions/create')
            ->submitForm('Save', $input)
            ->see('Permission created!')
            ->seePageIs('settings/permissions');
    }

    // public function testCreateDuplicatePermissionName()
    // {
    //     factory(Permission::class)->create(['name' => 'Permission Tests']);

    //     $input = [
    //         'name' => 'Permission Tests',
    //         'price' => 1000
    //     ];

    //     $this->actingAs($this->user)
    //         ->visit('settings/permissions/create')
    //         ->submitForm('Save', $input)
    //         ->see('The name has already been taken.')
    //         ->seePageIs('settings/permissions/create');
    // }

    public function testEditDataAvailable()
    {
        factory(Permission::class)->create();

        $this->actingAs($this->user)
            ->visit('settings/permissions/1/edit')
            ->see('Permissions - Edit');
    }

    public function testEditDataNotFound()
    {
        $this->actingAs($this->user)
            ->get('settings/permissions/1/edit')
            ->assertResponseStatus(404);
    }

    public function testUpdateSuccess()
    {
        factory(Permission::class)->create();

        $input = factory(Permission::class)->make()->toArray();

        $this->actingAs($this->user)
            ->visit('settings/permissions/1/edit')
            ->submitForm('Update', $input)
            ->see('Permission updated!')
            ->seePageIs('settings/permissions');
    }

    public function testDeleteSuccess()
    {
        factory(Permission::class)->create();

        $this->actingAs($this->user)
            ->visit('settings/permissions')
            ->submitForm('Delete')
            ->see('Permission deleted!')
            ->seePageIs('settings/permissions');
    }
}
