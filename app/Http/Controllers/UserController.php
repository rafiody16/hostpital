<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function insert(Request $req)
    {
        $validator = Validator::make($req -> all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:55|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator -> fails()) {
            return response() -> json([
                'success' => false,
                'message' => $validator -> errors(),
            ]);
        }

        $user = new User();
        $user -> name       = $req -> name;
        $user -> username   = $req -> username;
        $user -> role       = 'admin';
        $user -> password   = Hash::make($req -> password);
        $user -> save();

        $data = User::where('username', '=', $req->username) -> first();
        return response() -> json([
            'success' => true,
            'message' => 'Berhasil menambahkan user',
            'data' => $data
        ]);
    }

    public function login(Request $req)
    {
        $credentials = $req -> only('username', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response() -> json([
                    'success' => false,
                    'message' => 'invalid username and password'
                ]);
            }
        } catch (JWTException $e) {
            return response() -> json([
                'success' => false,
                'message' => 'invalid generate token'
            ]);
        }

        $data = [
            'token' => $token,
            'user'  => JWTAuth::user()
        ];

        return response() -> json([
            'success' => true,
            'message' => 'authentication success',
            'data' => $data
        ]);

    }
}
