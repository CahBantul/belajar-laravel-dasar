<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testCreateSession()
    {
        $this->get("/session/create")->assertSeeText('OK')
            ->assertSessionHas("userId", "Nozami")
            ->assertSessionHas("isMember", "true");
    }

    public function testGetSession()
    {
        $this->withSession([
                "userId" => "ajitama",
                "isMember" => "true"
            ])
            ->get("/session/get")
            ->assertSeeText('userId: ajitama, isMember: true')
            ->assertSessionHas("userId", "ajitama")
            ->assertSessionHas("isMember", "true");
    }

    public function testGetSessionFailed()
    {
        $this->get("/session/get")
            ->assertSeeText('userId: Guest, isMember: false');
    }
}
