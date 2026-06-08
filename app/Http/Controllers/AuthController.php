<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['email_verified_at'] = now();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $token = Auth::login($user);



        return apiResponse(201,'Register successfully',[
           'user'  => [
               'id'    => $user->id,
               'name'  => $user->name,
               'email' => $user->email,
           ],
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
       ]);

    }


    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $token = Auth::guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        $user = Auth::user();


        return apiResponse(200,'Login successfully',[
            'user'  => [
                'name'  => $user->name,
                'email' => $user->email,
            ],
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return apiResponse(200, 'Logout successfully');
    }

    public function refresh()
    {
        return apiResponse(200, 'Refresh successfully', [
            'authorisation' => [
                'token' => Auth::guard('api')->refresh(),
                'type'  => 'bearer',
            ]
        ]);
    }


    public function me()
    {
          $user = Auth::user();
          return apiResponse(200, $user);

    }

}
