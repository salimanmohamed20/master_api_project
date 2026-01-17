<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Traits\ApiResponse;
use App\Models\User;

class AuthController extends Controller
{
    use ApiResponse;
    public function login(LoginUserRequest $request){
        $request->validated($request->all());

        if(!auth()->attempt($request->only('email','password'))){
            return $this->error('invalid credentials',401);
        }

        $user=User::firstWhere('email',$request->email);
        $token=$user->createToken('api_token')->plainTextToken;
        return $this->ok("Authenticated",[
            "token"=>$token,
        ]);

    }
}
