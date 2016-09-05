<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class SupplierTest extends TestCase
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
        $input = factory(App\Supplier::class)->make()->toArray();

        $this->actingAs($this->user)
            ->visit('suppliers/create')
            ->submitForm('Save', $input)
            ->see('Supplier created!')
            ->seePageIs('suppliers');
    }

    public function testCreateDuplicateSupplierEmail()
    {
        factory(App\Supplier::class)->create(['email' => 'supplier@example.com']);

        $input = factory(App\Supplier::class)->make([
            'email' => 'supplier@example.com',
        ])->toArray();

        $this->actingAs($this->user)
            ->visit('suppliers/create')
            ->submitForm('Save', $input)
            ->see('The email has already been taken.')
            ->seePageIs('suppliers/create');
    }

    public function testEditDataAvailable()
    {
        factory(App\Supplier::class)->create();

        $this->actingAs($this->user)
            ->visit('suppliers/1/edit')
            ->see('Suppliers - Edit');
    }

    public function testEditDataNotFound()
    {
        $this->actingAs($this->user)
            ->get('suppliers/1/edit')
            ->assertResponseStatus(404);
    }

    public function testUpdateSuccess()
    {
        factory(App\Supplier::class)->create(['name' => 'Supplier Tests']);

        $input = factory(App\Supplier::class)->make()->toArray();

        $this->actingAs($this->user)
            ->visit('suppliers/1/edit')
            ->submitForm('Update', $input)
            ->see('Supplier updated!')
            ->seePageIs('suppliers');
    }

    public function testDeleteSuccess()
    {
        factory(App\Supplier::class)->create(['name' => 'Supplier Tests']);

        $this->actingAs($this->user)
            ->visit('suppliers')
            ->submitForm('Delete')
            ->see('Supplier deleted!')
            ->seePageIs('suppliers');
    }
}
