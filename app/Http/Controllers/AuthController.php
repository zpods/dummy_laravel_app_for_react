<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * function use to register user
     *
     * @param Request $request
     * @return JsonResponse 
     */
    public function register(Request $request) : JsonResponse
    {

        $fields = $request->validate(([
            'name'      => 'required|string',
            'email'     => 'required|string|unique:users,email',
            'password'  => 'required|string|confirmed'
        ]));

        $user = User::create([
            'name'      => $fields['name'],
            'email'     => $fields['email'],
            'password'  => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * function use to login user
     *
     * @param Request $request
     * @return JsonResponse 
     */
    public function login(Request $request) : JsonResponse
    {

        $fields = $request->validate(([
            'email'     => 'required|string|email',
            'password'  => 'required|string'
        ]));

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'message' => 'Bad credentials'
            ], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * logout function
     *
     * @param Request $request
     * @return JsonResponse 
     */
    public function logoutUser(Request $request) : JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out'
        ], 200);
    }
}
