<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormControllerTest extends TestCase
{
    public function testFormInput(): void
    {
        $this->post("/form", [
            "name" => "test",
        ])->assertSeeText("hello test");
    }
}
