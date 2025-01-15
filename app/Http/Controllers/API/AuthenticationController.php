<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function register(Request $request) {

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validation->fails()) {
            
            $message = [
                'message' => 'Error in data validations',
                'errors' => $validation->errors(),
                'status' => 400,
            ];

            return response()->json($message, 400);
            
        } else {
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password), 
            ]);

            $response = [
                'token' => $user->createToken('Token:')->plainTextToken,
                'name' => $user->name,
                'email' => $user->email,
            ];

            $message = [
                'message' => 'User Created',
                'data' => $response,
                'status' => 201,
            ];
    
            return response()->json($message, 201);

        }

    }

    public function login(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            
            $user = Auth::user();

            $response = [
                'token' => $user->createToken('Token:')->plainTextToken,
                'name' => $user->name,
                'email' => $user->email,
            ];

            $message = [
                'message' => 'Login successful',
                'data' => $response,
                'status' => 202,
            ];
    
            return response()->json($message, 202);

        } else {
            
            $message = [
                'message' => 'Authentication error',    
                'status' => 401,
            ];
    
            return response()->json($message, 401);

        }
    }

    public function logout() {

        $user = Auth::user();

        $user->tokens()->delete();

        $message = [
            'message' => 'Logout successful',
            'status' => 200,
        ];

        return response()->json($message, 200);

    }
}
