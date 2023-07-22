<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContohMiddlewareTest extends TestCase
{
    public function testMiddlewareInvalid(): void
    {
        $this->get("/middleware/api")
            ->assertStatus(401)
            ->assertSeeText('Access denied');
    }

    public function testMiddlewareValid(): void
    {
        $this->withHeader("X-API-KEY", "NZM")
            ->get("/middleware/api")
            ->assertStatus(200)
            ->assertSeeText('Ok');
    }

    public function testMiddlewareInvalidGroup(): void
    {
        $this->get("/middleware/group")
            ->assertStatus(401)
            ->assertSeeText('Access denied');
    }

    public function testMiddlewareValidGroup(): void
    {
        $this->withHeader("X-API-KEY", "NZM")
            ->get("/middleware/group")
            ->assertStatus(200)
            ->assertSeeText('GROUP');
    }
}
