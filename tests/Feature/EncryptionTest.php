<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    public function testEncryption(): void
    {
        $encrypt = Crypt::encrypt("Fardan Nozami");
        $dencrypt = Crypt::decrypt($encrypt);

        self::assertEquals("Fardan Nozami", $dencrypt);
    }
}
