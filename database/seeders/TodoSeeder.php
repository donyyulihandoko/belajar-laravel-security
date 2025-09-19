<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Todo;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->where('email', 'user1@example.com')->firstOrFail();
        $todo = new Todo();
        $todo->title = 'Example Todo';
        $todo->user_id = $user->id;
        $todo->save();
    }
}
