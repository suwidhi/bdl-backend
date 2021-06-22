<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => 3, # anyone wanna login? get user privilege hahaha...
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createToken('token')->plainTextToken;
        
        return response([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request){
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string' 
        ]);

        $user = User::where('email', $data['email'])->first();

        if(!$user || !Hash::check($data['password'], $user->password)){
            return response('Login invalid', 503);
        }
        $token = $user->createToken($user->email)->plainTextToken;

        return response([
            'token' => $token, 
            'user' => $user
        ])->header('Set-Cookie', 'X-Sanctum-Token=' . $token);
    }

    public function update(Request $request){

        $request->validate([
            'name' => 'string',
            'password' => 'string|required'
        ]);
        
        $user = $request->user();
        $user->name = $data['name'];
        $user->password = bcrypt($data['password']);
        
        return $user->save();
    }

    public function createSession(){
        $user = Auth::user();

        if($user){
            return response([
                'user' => $user
            ], 200);
        } else {
            return response([], 204);
        }
    }

    public function logout(Request $request){
        $user = Auth::user();

        if($user){
            $user->tokens()->delete();

            return response([], 200);
        }
    }
}
