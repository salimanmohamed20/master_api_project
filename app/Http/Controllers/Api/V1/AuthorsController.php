<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\V1\AuthorFilter;
use App\Http\Resources\V1\UserResource;
use App\Models\User;


class AuthorsController extends ApiController
{
    public function index(AuthorFilter $filters)
    {
        return UserResource::collection(User::filter($filters)->paginate());
    }

    public function show(User $user)
    {
        if($this->include('ticket')){
            return new UserResource($user->load('tickets'));
        }
        return new UserResource($user);
    }
}
