<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Permissions\V1\Abilities;
use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Traits\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    use ApiResponse;

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        if (!auth()->attempt($request->only('email', 'password'))) {
            return $this->error('invalid credentials', 401);
        }

        $user = User::firstWhere('email', $request->email);
        $token = $user->createToken('api_token for' . $user->email ,[Abilities::getAbilities($user)],now()->addMonth())->plainTextToken;
        return $this->ok("Authenticated", [
            "token" => $token,
        ]);

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->ok(" ");
    }
}
