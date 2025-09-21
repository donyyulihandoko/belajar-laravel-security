<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    public function testEncryption()
    {
        $value = 'Dony Yuli Handoko';
        $encrypted = Crypt::encrypt($value);
        $decrypted = Crypt::decrypt($encrypted);
        self::assertEquals($value, $decrypted);
    }
}
