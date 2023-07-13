<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    function testConfig(): void
    {
        $firstName = config('contoh.author.first');
        $lastName = config('contoh.author.last');
        $email = config('contoh.email');
        $web = config('contoh.web');

        self::assertEquals("Fardan", $firstName);
        self::assertEquals("Nozami", $lastName);
        self::assertEquals("fardan.nozami@gmail.com", $email);
        self::assertEquals("https://www.nozami.id", $web);
    }
}
