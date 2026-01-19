<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\V1\TicketFilter;
use App\Http\Resources\V1\TicketResource;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Api\V1\TicketRequest;
use App\Http\Requests\Api\V1\ReplaceTicketRequest;
use App\Http\Requests\Api\V1\UpdateTicketRequest;



class AuthorTicketsController extends ApiController
{
    public function index($author_id,TicketFilter $filters)
    {
        return TicketResource::collection(Ticket::where('user_id', $author_id)->filter($filters)->paginate());

    }

     public function store($author_id,TicketRequest $request)
    {
        
        
        return new TicketResource(Ticket::create($request->mappedAttributes()));

  
    }


    public function replace($author_id,$ticket_id,ReplaceTicketRequest $request)
    {
        try{
            $ticket=Ticket::findOrFail($ticket_id);
            $ticket->update($request->mappedAttributes());
            return new TicketResource($ticket);
        }catch(ModelNotFoundException){
            return $this->error("Ticket not found",404);
        }
    }


    public function update($author_id,$ticket_id,UpdateTicketRequest $request)
    {
        try{
            $ticket=Ticket::findOrFail($ticket_id);
            $ticket->update($request->mappedAttributes());
            return new TicketResource($ticket);
        }catch(ModelNotFoundException){
            return $this->error("Ticket not found",404);
        }
    }
}
