<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{

    public function index()
    {
        $auth = Auth::all();
        return new Auth($auth);
    }

    public function getUser(Request $request)
    {
        return response()->json($request->user());
    }



    public function register(Request $request){


        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|string|unique:users',
            'password'=>'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        return response()->json(['massage'=>'Пользватель успешно зарегистрирован!']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'boolean',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (!Auth::attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'email' => ['Неверные учетные данные.'],
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->delete();

        return response()->json(['message' => 'Вы вышли из системы']);
    }
}



