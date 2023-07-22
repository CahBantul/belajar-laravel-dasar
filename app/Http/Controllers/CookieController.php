<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    public function createCookie(): Response
    {
        return response("hello cookie")
            ->cookie("user-Id", "Nozami", 1000, "/")
            ->cookie("is-Member", true, 1000, "/");
    }

    public function getCookie(Request $request): JsonResponse
    {
        return response()
            ->json([
                "userId" => $request->cookie("user-Id", "guest"),
                "isMember" => $request->cookie("is-Member", false),
            ]);
    }

    public function clearCookie(Request $request): JsonResponse
    {
        return response("clear cookie")
            ->withoutCookie("user-Id")
            ->withoutCookie("is-Member")
            ->json([
                "userId" => $request->cookie("user-Id", "guest"),
                "isMember" => $request->cookie("is-Member", false),
            ]);
    }
}
