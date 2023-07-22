<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testSetCookie(): void
    {
        $this->get("/cookie/set")
            ->assertSeeText("hello cookie")
            ->assertCookie("user-Id", "Nozami")
            ->assertCookie("is-Member", true);
    }

    public function testGetCookie(): void
    {
        $this->withCookie("user-Id", "Nozami")
            ->withCookie("is-Member", true)
            ->get("/cookie/get")
            ->assertJson([
                "userId" => "Nozami",
                "isMember" => true
            ]);
    }

    public function testClearCookie(): void
    {
        $response = $this->get("/cookie/clear");
        dd($response->assertJson([
            "user-Id" => "Nozami"
        ]));
    }
}
