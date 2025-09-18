<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    public function testAuth()
    {
        $this->seed([UserSeeder::class]);
        $response = Auth::attempt([
            'email' => 'user1@example.com',
            'password' => 'password'
        ], true);

        self::assertTrue($response);

        $user = Auth::user();
        self::assertNotNull($user);
        self::assertEquals('user1@example.com', $user->email);
    }

    public function testGuest()
    {
        $user = Auth::user();
        self::assertNull($user);
    }

    public function testLoginRequest()
    {
        $this->seed([UserSeeder::class]);
        $this->get("/users/login?email=user1@example.com&password=password")
            ->assertRedirect('/users/current');

        $this->get("/users/login?email=user1@example.com&password=salah")
            ->assertSeeText('wrong credentials');
    }

    public function testCurrent()
    {
        $this->seed([UserSeeder::class]);
        $this->get('users/current')
            ->assertStatus(302)
            ->assertRedirect(\route('login'));

        $user = User::where('email', 'user1@example.com')->firstOrFail();
        $this->actingAs($user)
            ->get('users/current')
            ->assertSeeText("Hello user1");
    }
}
