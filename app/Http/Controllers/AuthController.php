<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use Exception;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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
                'user' => new UserResource($newUser),
            ], 201);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function login(LoginUserRequest $request)
    {
        try {

            $authAttempt = Auth::attempt($request->only('email', 'password'));
            if ($authAttempt) {
                $user = User::where('email', $request->email)->firstOrFail();
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'user' => new UserResource($user),
                    'access_token' => $token,
                    'token_type' => 'Bearer'
                ], 200);
            } else {
                return response()->json([
                    'user' => "Invalid login details"
                ], 401);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json([
                'message' => 'Logged out'
            ], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function me()
    {
        return false;
    }
}
