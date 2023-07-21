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

    public function testFallbackPost() : void {
        $this->post('/tidak-ada')
            ->assertSeeText('salah');
    }

    public function testRouteParameter() : void {
        $this->get('/products/1')
            ->assertSeeText('product 1');

        $this->get('/products/2')
            ->assertSeeText('product 2');

        $this->get('/products/1/items/xxx')
            ->assertSeeText('Product 1 item xxx');

        $this->get('/products/2/items/yyy')
            ->assertSeeText('Product 2 item yyy');
    }

    public function testRouteParameterRegex() : void {
        $this->get('/categories/100')
            ->assertSeeText('Category 100');

        $this->get('/categories/eko')
            ->assertSeeText('404 by Nozami');
    }

    public function testRouteParameterOptional() : void {
        $this->get('/users/nozami')
            ->assertSeeText('User nozami');

        $this->get('/users')
            ->assertSeeText('User 404');
    }

    public function testRouteConflict() : void {
        $this->get('/conflict/budi')
            ->assertSeeText('conflict budi');

        $this->get('/conflict/nozami')
            ->assertSeeText('Fardan Nozami');
    }

    public function testNamedRoute() : void {
        $this->get("/produk/123456")
            ->assertSeeText("Link http://localhost/products/id%20=%3E%20123456");

        $this->get("/produk-redirect/123456")
            ->assertRedirect("/products/123456");
    }

}
