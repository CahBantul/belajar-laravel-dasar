<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(Response $response): Response
    {
        return response("Hello Response");
    }

    public function header(Response $response): Response
    {
        $body = ["firstName" => "Fardan", "middle" => "Nozami", "lastName" => "Ajitama"];
        
        return response(json_encode($body), 200)
            ->header('Content-Type', 'application/json')
            ->withHeaders([
                'Author' => 'Fardan Nozami',
                'App' => 'Belajar Laravel'
            ]);
    }

    public function responseView(Response $response): Response
    {
        return response()
                ->view("hello", [
                    "name" => "Nozami"
                ]);
    }

    public function responseJson(Response $response): JsonResponse
    {
        $body = [
            'firstName' => 'Fardan',
            'lastName' => 'Nozami'
        ];

        return response()
                ->json($body);
    }

    public function responseFile(Response $response): BinaryFileResponse
    {
        return response()
                ->file(storage_path('app/public/pictures/fardan.png'));
    }

    public function responseDownload(Response $response): BinaryFileResponse
    {
        return response()
                ->download(storage_path('app/public/pictures/fardan.png'));
    }
}
