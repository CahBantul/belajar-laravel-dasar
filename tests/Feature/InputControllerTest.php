<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput(): void
    {
        $this->get('/input/get?name=nozami')
            ->assertSeeText("Hello nozami");

        $this->post('/input/post', ["name" => "ajitama"])
            ->assertSeeText("Hello ajitama");
    }

    public function testNestedInput(): void
    {
        $this->post('/input/post/first', ["name" => [
            "first" => "ajitama"
        ]])
            ->assertSeeText('Hello ajitama');
    }

    public function testInputAll(): void
    {
        $this->post('/input/hello/input', [
            "name" => [
                "first" => "ajitama"
        ]])->assertSeeText('name')->assertSeeText("first")->assertSeeText("ajitama");
    }

    public function testArrayInput(): void
    {
        $this->post('/input/hello/array', [
            "products" => [
                ["name" => "Acer", "price" => 2000],
                ["name" => "Asus", "price" => 5000],
                ["name" => "Mac Book", "price" => 20000],
        ]])->assertSeeText('Acer')->assertSeeText("Asus")->assertSeeText("Mac Book");
    }

    public function testInputType(): void
    {
        $this->post('/input/type', [
           "name" => "Fardan Nozami",
           "isMarried" => "true",
           "birthDate" => "1992-03-31",
        ])->assertSeeText('Fardan Nozami')->assertSeeText("true")->assertSeeText("1992-03-31");
    }

    public function testFilterOnly(): void
    {
        $this->post('/input/only', [
           "name" => [
            "first" => "Fardan",
            "middle" => "Nozami",
            "last" => "Ajitama"
           ]
        ])->assertSeeText('Fardan')->assertSeeText("Ajitama")->assertDontSeeText("Nozami");
    }

    public function testFilterExcept(): void
    {
        $this->post('/input/except', [
           "username" => "nozami",
           "admin" => "true",
           "password" => "password"
        ])->assertSeeText('nozami')->assertSeeText("password")->assertDontSeeText("admin");
    }

    public function testFilterMerge(): void
    {
        $this->post('/input/merge', [
           "username" => "nozami",
           "admin" => "true",
           "password" => "password"
        ])->assertSeeText('nozami')->assertSeeText("password")->assertSeeText("false");
    }
}
