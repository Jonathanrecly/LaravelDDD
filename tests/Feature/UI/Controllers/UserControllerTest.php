<?php

namespace Tests\Feature\UI\Controllers;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    const ROUTE = 'user';

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs((new UserFactory)->create());
    }

    /** @test */
    public function it_should_store_new_user(): void
    {
        $response = $this->postJson(route('user.store'), [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => 'secret',
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
        ]);
    }
}
