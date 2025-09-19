<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class GuestTest extends TestCase
{
    public function testGuest()
    {
        self::assertTrue(Gate::allows('create', User::class));
    }

    public function testLogged()
    {
        $this->seed([UserSeeder::class]);
        $user = User::where('name', 'user1')->firstOrFail();
        Auth::login($user);
        $create = Gate::allows('create', User::class);
        self::assertFalse($create);
    }
}
