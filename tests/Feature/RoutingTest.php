<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testBasicRouting() : void {
        $this->get('/nozami')
            ->assertStatus(200)
            ->assertSeeText('Hello Nozami');
    }

    public function testRedirect() : void {
        $this->get('/youtube')
            ->assertRedirect('/nozami');
    }

    public function testFallback() : void {
        $this->get('/tidak-ada')
            ->assertSeeText('404 by Nozami');
    }
}
