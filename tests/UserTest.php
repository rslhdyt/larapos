<?php

namespace Tests;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends AuthTestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateSuccess()
    {
        $input = factory(User::class)->make(['role_id' => function () {
            return factory(Role::class)->create()->id;
        }])->toArray();

        $input['password'] = 12345678;
        $input['password_confirmation'] = 12345678;

        $this->actingAs($this->user)
            ->visit('users/create')
            ->submitForm('Save', $input)
            ->see('User created!')
            ->seePageIs('users');
    }

    public function testCreateDuplicateUserEmail()
    {
        factory(User::class)->create(['email' => 'user@example.com']);

        $input = factory(User::class)->make([
            'email' => 'user@example.com',
        ])->toArray();

        $this->actingAs($this->user)
            ->visit('users/create')
            ->submitForm('Save', $input)
            ->see('The email has already been taken.')
            ->seePageIs('users/create');
    }

    public function testEditDataAvailable()
    {
        factory(User::class)->create();

        $this->actingAs($this->user)
            ->visit('users/1/edit')
            ->see('Users - Edit');
    }

    public function testEditDataNotFound()
    {
        $this->actingAs($this->user)
            ->get('users/2/edit')
            ->assertResponseStatus(404);
    }

    public function testUpdateSuccess()
    {
        factory(User::class)->create(['name' => 'User Tests']);

        $input = factory(User::class)->make(['role_id' => function () {
            return factory(Role::class)->create()->id;
        }])->toArray();

        $this->actingAs($this->user)
            ->visit('users/1/edit')
            ->submitForm('Update', $input)
            ->see('User updated!')
            ->seePageIs('users');
    }

    public function testDeleteSuccess()
    {
        factory(User::class)->create(['name' => 'User Tests']);

        $this->actingAs($this->user)
            ->visit('users')
            ->submitForm('Delete')
            ->see('User deleted!')
            ->seePageIs('users');
    }
}
