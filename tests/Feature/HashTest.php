<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HashTest extends TestCase
{
    public function testHashNotEquals()
    {
        $password = 'password';
        $password2 = 'password';

        $hash = Hash::make($password);
        $hash2 = Hash::make($password2);

        self::assertNotEquals($hash, $hash2);
    }

    public function testHashCheck()
    {
        $password = 'password';
        $hash = Hash::make($password);
        $result = Hash::check($password, $hash);
        self::assertTrue($result);
    }
}
