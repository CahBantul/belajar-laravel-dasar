<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{

    public function testGetEnv()
    {
        $youtube = env('YOUTUBE');

        self::assertEquals('Nozami', $youtube);
    }

    public function testDefaultValue()
    {
        $author = env('AUTHOR', 'Fardan');

        self::assertEquals('Fardan', $author);
    }
}
