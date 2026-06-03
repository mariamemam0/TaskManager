<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['email_verified_at'] = now();
        $user = User::create($data);
       $token = Str::random(64);
       Token::create([
           'user_id' => $user->id,
           'token' => $token,
       ]);


       return apiResponse(201,'Register successfully',[
           'user'  => [
               'id'    => $user->id,
               'name'  => $user->name,
               'email' => $user->email,
           ],
           'token' => $token,
       ]);

    }


    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return apiResponse(401,'Invalid credentials');
        }
        $token = Str::random(64);

        Token::create([
            'user_id' => $user->id,
            'token' => $token,
        ]);
        return apiResponse(200,'Login successfully',[
            'user'  => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
            ],
            'token' => $token,
        ]);
    }


    public function logout(Request $request)
    {
        Token::where('token', $request->bearerToken())->delete();
        return apiResponse(200, 'Logout successfully');
    }

}
