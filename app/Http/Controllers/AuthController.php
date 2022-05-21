<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\RegisterUserResource;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        try {
            $newUser = User::create([
                "email" => $request->email,
                "name" => $request->name,
                "password" => Hash::make($request->password),
            ]);

            $token = $newUser->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => new RegisterUserResource($newUser)
            ], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                "error" => $e->getMessage(),
            ], 500);
        }
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
