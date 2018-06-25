<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $users = factory(User::class, 5)->create();

        $response = $this->actingAs($this->authUser)
            ->get('users');

        $response->assertStatus(200)
            ->assertViewHas('users');
    }

    public function testTrash()
    {
        $users = factory(User::class, 5)->create(['deleted_at' => Carbon::now()]);

        $response = $this->actingAs($this->authUser)
            ->get('users/trash');

        $response->assertStatus(200)
            ->assertViewHas('users');
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->authUser)
            ->get('users/create');

        $response->assertStatus(200);
    }

    public function testStoreSuccess()
    {
        $data = [
            'name' => 'banana',
            'email' => 'banana@choco.cheese',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ];

        $response = $this->actingAs($this->authUser)
            ->post('users', $data);

        $response->assertStatus(302);
        
        $this->assertDatabaseHas('users', [
            'name' => $data['name']
        ]);
    }

    public function testStoreValidationFailed()
    {
        $response = $this->actingAs($this->authUser)
            ->post('users', []);

        $response->assertStatus(302)
            ->assertSessionHasErrors();
    }
    
    public function testShow()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($this->authUser)
            ->get('users/' . $user->id);

        $response->assertStatus(200)
            ->assertViewHas('user');
    }

    public function testEdit()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($this->authUser)
            ->get('users/' . $user->id . '/edit');

        $response->assertStatus(200)
            ->assertViewHas('user');
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $data = $user->toArray();
        $data['name'] = 'updated user';

        $response = $this->actingAs($this->authUser)
            ->put('users/' . $user->id, $data);

        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'name' => 'updated user'
        ]);
    }
}
