<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    public function testUpload(): void
    {
        $image = UploadedFile::fake()->image('fardan.png');
        $this->post('/file/upload', [
            'picture' => $image
        ])->assertSeeText("OK fardan.png");
    }
}
