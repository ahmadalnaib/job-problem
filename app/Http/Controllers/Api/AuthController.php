<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    public function register(Request $request): string
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => ['required', 'confirmed', Password::defaults()],
      
    ]);
 
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
 
 return $user->createToken('api')->plainTextToken;
}

public function login(Request $request): string
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        
    ]);
 
    $user = User::where('email', $request->email)->first();
 
    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
 
        return $user->createToken('api')->plainTextToken;
}

public function logout(Request $request)
{
    $user = User::where('email', $request->email)->first();
 
    if ($user) {
        $user->tokens()->delete();
    }
 
    return response()->noContent();
}
}
