<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request)
    {
        $request->session()->put("userId", "Nozami");
        $request->session()->put("isMember", "true");

        return "OK";
    }

    public function getSession(Request $request)
    {
        $userId = $request->session()->get("userId", "Guest");
        $isMember = $request->session()->get("isMember", "false");

        return "userId: $userId, isMember: $isMember";
    }
}
