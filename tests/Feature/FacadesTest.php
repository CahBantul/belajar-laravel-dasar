<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadesTest extends TestCase
{
    public function testConfig() : void {
        $firstName1 = config("contoh.author.first");
        $firstName2 = Config::get("contoh.author.first");

        self::assertSame($firstName1, $firstName2);
    }

    public function testConfigDependency() : void {
        $config = $this->app->make('config');
        $firstName1 = config("contoh.author.first");
        $firstName2 = Config::get("contoh.author.first");
        $firstName3 = $config->get("contoh.author.first");

        self::assertSame($firstName1, $firstName3);
    }

    public function testFacadeMock() : void {
        Config::shouldReceive('get')
            ->with("contoh.author.first")
            ->andReturn("Fardan Keren");
        
        $firstName = Config::get("contoh.author.first");

        self::assertEquals("Fardan Keren", $firstName);
    }
}
