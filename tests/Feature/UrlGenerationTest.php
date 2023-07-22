<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlGenerationTest extends TestCase
{
    public function testUrlCurrent(): void
    {
        $this->get("/url/current?name=Nozami")
            ->assertSeeText("/url/current?name=Nozami");
    }

    public function testUrlAction(): void
    {
        $this->get("/url/action")
            ->assertStatus(200)
            ->assertSeeText("/form");
    }
}
