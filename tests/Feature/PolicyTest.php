<?php

namespace Tests\Feature;

use Database\Seeders\TodoSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PolicyTest extends TestCase
{
    public function testPolicy()
    {
        $this->seed([UserSeeder::class, TodoSeeder::class]);
        $user = User::query()->where('email', 'user1@example.com')->firstOrFail();
        Auth::login($user);

        $todo = Todo::first();
        self::assertTrue(Gate::allows('view', $todo));
        self::assertTrue(Gate::allows('viewAny', $todo));
        self::assertTrue(Gate::allows('delete', $todo));
        self::assertTrue(Gate::allows('forceDelete', $todo));
        self::assertTrue(Gate::allows('create', Todo::class));
        self::assertTrue(Gate::allows('update', $todo));
    }

    public function testAutorizable()
    {
        $this->seed([UserSeeder::class, TodoSeeder::class]);
        $user = User::query()->where('email', 'user1@example.com')->firstOrFail();

        $todo = Todo::first();
        self::assertTrue($user->can('view', $todo));
        self::assertTrue($user->can('viewAny', $todo));
        self::assertTrue($user->can('delete', $todo));
        self::assertTrue($user->can('forceDelete', $todo));
        self::assertTrue($user->can('create', Todo::class));
        self::assertTrue($user->can('update', $todo));
    }
}
