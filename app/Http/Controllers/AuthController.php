<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request) {
        // setup validator
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:8'
        ]);

        // cek validator
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // cek keberhasilan
        if ($user) {
            return response()->json([
                'succes'  => true,
                'message' => 'user created successfully',
                'data'    => $user
            ], 201);
        }

        // cek gagal
        return response()->json([
            'succes'  => false,
            'message' => 'user creation failed'
        ], 409);
    }

    public function login(Request $request) {
        // setup validator
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // cek validator
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // get kredensial dari request
        $credential = $request->only('email', 'password');

        // cek isfailed
        if (!$token = auth()->guard('api')->attempt($credential)) {
            return response()->json([
                'succes'  => false,
                'message' => 'email dan password anda salah'
            ], 401);
        }

        // cek issucces
        return response()->json([
            'succes'  => true,
            'message' => 'login successfully',
            'user'    => auth()->guard('api')->user(),
            'token'   => $token,
        ], 200);
    }

    public function logout(Request $request) {
        //try catch
        //invalidate token
        //cek issucces
        
        //catch
        //cek isfailed
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'succes' => true,
                'message' => 'logout succesfully'
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'succes' => 'false',
                'message' => 'logout failed'
            ], 500);
        }
    }
}