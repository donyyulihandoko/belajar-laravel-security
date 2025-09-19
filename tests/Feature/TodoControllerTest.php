<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Todo;
use Database\Seeders\UserSeeder;
use Database\Seeders\TodoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    public function testTodo()
    {
        $this->seed([UserSeeder::class, TodoSeeder::class]);

        $this->post("/api/todo")
            ->assertStatus(403);

        $user = User::where("email", "user1@example.com")->firstOrFail();
        $this->actingAs($user)
            ->post("/api/todo")
            ->assertStatus(200);
    }

    public function testView()
    {
        $this->seed([UserSeeder::class, TodoSeeder::class]);
        $user = User::where('email', 'user1@example.com')->firstOrFail();
        Auth::login($user);

        $todo = Todo::get();

        $this->view('todo', [
            'todos' => $todo
        ])->assertSeeText('Edit')
            ->assertSeeText('Delete')
            ->assertDontSeeText('No Edit')
            ->assertDontSeeText('No Delete')
        ;
    }

    public function testGuest()
    {
        $this->seed([UserSeeder::class, TodoSeeder::class]);
        // $user = User::where('email', 'user1@example.com')->firstOrFail();
        // Auth::login($user);

        $todo = Todo::get();

        $this->view('todo', [
            'todos' => $todo
        ])->assertSeeText('No Edit')
            ->assertSeeText('No Delete');
        // ->assertDontSeeText('Edit')
        // ->assertDontSeeText('Update');
    }
}
