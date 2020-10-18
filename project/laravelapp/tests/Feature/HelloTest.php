<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HelloTest extends TestCase
{
    use DatabaseMigrations;

    public function testHello()
    {
        $this->assertTrue(true);

        $response= $this->get('/');
        $response->assertStatus(200);

        $response= $this->get('/hello');
        $response->assertStatus(302);

        $user = User::factory()->create();
        $response= $this->actingAs($user)->call('GET','/hello', ['sort'=>'age']);
        $response->assertStatus(200);

        $response= $this->get('/no_route');
        $response->assertStatus(404);
    }
}
