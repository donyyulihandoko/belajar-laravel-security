<?php

namespace Tests\Feature;

use Database\Seeders\ContactSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class GateTest extends TestCase
{
    public function testGate()
    {
        $this->seed([UserSeeder::class, ContactSeeder::class]);
        $user = User::query()->where('email', 'user1@example.com')->first();
        Auth::login($user);

        $contact = Contact::query()->where('name', 'Test Contact')->first();

        self::assertTrue(Gate::allows('get-contact', $contact));
        self::assertTrue(Gate::allows('update-contact', $contact));
        self::assertTrue(Gate::allows('delete-contact', $contact));
    }
}
