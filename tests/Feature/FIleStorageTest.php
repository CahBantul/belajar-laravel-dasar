<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FIleStorageTest extends TestCase
{
    public function testStorage(): void
    {
        $filesystem = Storage::disk('local');

        $filesystem->put('file.txt', "Fardan Nozami Ajitama");
        $content = $filesystem->get("file.txt");
        self::assertEquals("Fardan Nozami Ajitama", $content);
    }

    public function testPublicStorage(): void
    {
        $filesystem = Storage::disk('public');

        $filesystem->put('file.txt', "Fardan Nozami Ajitama");
        $content = $filesystem->get("file.txt");
        self::assertEquals("Fardan Nozami Ajitama", $content);
    }
}
