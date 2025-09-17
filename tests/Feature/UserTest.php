<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

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
}
