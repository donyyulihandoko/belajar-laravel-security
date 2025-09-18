<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->where('email', 'user1@example.com')->first();
        $contact = new Contact();
        $contact->name = 'Test Contact';
        $contact->email = 'testcontact@test.com';
        $contact->phone = '089xxxxxxxx';
        $contact->address = 'Sample Address';
        $contact->user_id = $user->id;
        $contact->save();
    }
}
