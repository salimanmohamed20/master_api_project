<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;

class UserController extends ApiController
{
    public function index()
    {
        return UserResource::collection(User::with('tickets')->paginate());
    }

    public function show(User $user)
    {
        if($this->include('ticket')){
            return new UserResource($user->load('tickets'));
        }
        return new UserResource($user);
    }
}
