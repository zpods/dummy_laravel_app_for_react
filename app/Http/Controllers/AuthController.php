<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    /**
     * function to register user
     *
     * @param Request $request
     * @return Response 
     */
    public function register(Request $request)
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

        return response([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * function to login user
     *
     * @param Request $request
     * @return Response 
     */
    public function login(Request $request)
    {

        $fields = $request->validate(([
            'email'     => 'required|string|email',
            'password'  => 'required|string'
        ]));

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * logout function
     *
     * @param Request $request
     * @return Response 
     */
    public function logoutUser(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response([
            'message' => 'Logged out'
        ], 200);
    }
}
