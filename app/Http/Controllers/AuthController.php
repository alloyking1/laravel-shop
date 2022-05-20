<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
// use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(AuthRequest $request)
    {
        return "form validated";
    }

    public function login()
    {
        return false;
    }

    public function me()
    {
        return false;
    }
}
