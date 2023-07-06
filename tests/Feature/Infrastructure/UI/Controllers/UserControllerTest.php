<?php

namespace Tests\Feature\Infrastructure\UI\Controllers;

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
    public function it_should_list_users(): void
    {
        // setup
        (new UserFactory)->count(3)->create();

        // test
        $response = $this->getJson(route('user.index'));

        // assert
        $response->assertSuccessful();

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'uuid',
                    'name',
                    'email',
                ],
            ],
        ]);

        $response->assertJsonCount(4, 'data');
    }

    /** @test */
    public function it_should_store_new_user(): void
    {
        // test
        $response = $this->postJson(route('user.store'), [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => 'secret',
        ]);

        // assert
        $response->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
        ]);
    }

    /**
     * @dataProvider validFilterProvider
     *
     * @test
     */
    public function it_should_filter_user_list($filter): void
    {
        // setup
        (new UserFactory)->count(3)->create();
        (new UserFactory)->create([
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => 'secret',
        ]);

        // test
        $response = $this->getJson(route('user.index', [
            'filter' => $filter,
        ]));

        // assert
        $response->assertSuccessful();

        $response->assertJsonCount(1, 'data');
    }

    public static function validFilterProvider(): array
    {
        return [
            'filter by name' => [['name' => 'John Doe']],
            'filter by email' => [['email' => 'john@doe.com']],
        ];
    }
}
