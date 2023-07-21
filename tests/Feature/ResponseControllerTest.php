<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse(): void
    {
        $this->get("/response/hello")
            ->assertStatus(200)
            ->assertSeeText('Hello Response');
    }

    public function testHeader(): void
    {
        $this->get("/response/header")
            ->assertStatus(200)
            ->assertSeeText('Fardan')->assertSeeText("Nozami")->assertSeeText("Ajitama")
            ->assertHeader("Content-Type", "application/json")
            ->assertHeader('Author', 'Fardan Nozami')
            ->assertHeader("App", "Belajar Laravel");
    }

    public function testView(): void
    {
        $this->get("/response/type/view")
            ->assertStatus(200)
            ->assertSeeText('hello Nozami');
    }

    public function testJson(): void
    {
        $this->get("/response/type/json")
            ->assertStatus(200)
            ->assertJson(['firstName' => 'Fardan', 'lastName' => 'Nozami']);
    }

    public function testFile(): void
    {
        $this->get("/response/type/file")
            ->assertHeader("Content-Type", "image/png");
    }

    public function testDownload(): void
    {
        $this->get("/response/type/download")
            ->assertDownload("fardan.png");
    }
}
