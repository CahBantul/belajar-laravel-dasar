<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    public function testHello(): void
    {
        $this->get("/controller/hello/fardan")
            ->assertSeeText("Halo fardan");
    }

    public function testRequest(): void
    {
        $this->get("/controller/hello/request", ['Accept' => 'plain/text'])
            ->assertSeeText("/controller/hello/request")
            ->assertSeeText("http://localhost/controller/hello/request")
            ->assertSeeText("GET")
            ->assertSeeText("plain/text");
    }
}
