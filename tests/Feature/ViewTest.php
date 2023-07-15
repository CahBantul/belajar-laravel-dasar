<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView(): void
    {
        $this->get('/hello')
            ->assertSeeText("hello nozami");
    }

    public function testViewHelloWorld(): void
    {
        $this->get('/hello-world')
            ->assertSeeText("halo boss ajitama");
    }

    public function testViewWithoutRoute(): void
    {
        $this->view('hello.world', [ "name" => "nozami"])
            ->assertSeeText("halo boss nozami");
    }
}
