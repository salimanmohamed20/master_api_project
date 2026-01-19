<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\V1\AuthorFilter;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Ticket;



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


      public function destroy( $author_id,$ticket_id)
    {
        try{
            $ticket=Ticket::findOrFail($ticket_id);
            if($ticket->user_id==$author_id){
         
                $ticket->delete();
            }
        }catch(ModelNotFoundException){

            return $this->error("Ticket not found",404);
        }
    }
}
