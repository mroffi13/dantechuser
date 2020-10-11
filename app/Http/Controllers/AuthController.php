<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function register(Request $request)
    {
        if ($request->header('x-api-key') == 'HrwCTKGnwDXO25ePj5UNkC1G8QOZKpGm') {
            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');
            $address = $request->input('address');

            $this->validate($request, [
                'name'  => 'required|min:5',
                'email' => 'required|unique:users|email',
                'address' => 'required',
                'password' => 'required|confirmed',
            ]);

            $user = User::create([
                'name'  => $name,
                'email' => $email,
                'address' => $address,
                'password' => Hash::make($password),
                'api_token' => Str::random(40)
            ]);

            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'Register success',
                    'user' => $user,
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Register fail',
                    'data' => '',
                ], 400);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => 'wrong api-key!',
            ], 400);
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'  => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();



        if ($user) {
            if (Hash::check($request->input('password'), $user->password)) {
                return response()->json([
                    'error' => false,
                    'message' => 'Login successfully',
                    'data' => [
                        'user' => $user,
                        'meta'  => [
                            'token' => $user->api_token,
                        ]
                    ]
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Login fail, wrong password!',
                    'data' => ''
                ], 400);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => 'These credentials do not match our records.',
                'data' => ''
            ], 400);
        }
    }
}
