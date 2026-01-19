<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\V1\TicketFilter;
use App\Http\Requests\Api\V1\ReplaceTicketRequest;
use App\Http\Requests\Api\V1\TicketRequest;
use App\Http\Requests\Api\V1\UpdateTicketRequest;
use App\Http\Resources\V1\TicketResource;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TicketController extends ApiController
{
    public function index(TicketFilter $filters)
    {
        return TicketResource::collection(Ticket::filter($filters)->paginate());
    }

    public function store(TicketRequest $request)
    {
        try{
            $this->isAble('store',Ticket::class);


        }catch(ModelNotFoundException){

            return $this->ok([
                'message' => 'User not found',
                'errors' => [
                    'user' => ['User not found'],
                ]
            ]);
        }
        
        return new TicketResource(Ticket::create($request->validated()));

  
    }

    public function show($ticket_id)
    {
       try{
            $ticket=Ticket::findOrFail($ticket_id);
           if($this->include('author')){
               return new TicketResource($ticket->load('author'));
           }
           return new TicketResource($ticket);
       }catch(ModelNotFoundException){

                   return $this->error("Ticket not found",404);

       }
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket_id)
    {
        try{
            $ticket=Ticket::findOrFail($ticket_id);

         $this->isAble('update',$ticket);
     
         $ticket->update($request->mappedAttributes());

          return new TicketResource($ticket);
        }
        catch(ModelNotFoundException){

            return $this->error("Ticket not found",404);
        }
       
    }

    public function destroy($ticket_id)
    {
        try{
            $ticket=Ticket::findOrFail($ticket_id);
         
                $ticket->delete();
            
        }catch(ModelNotFoundException){

            return $this->error("Ticket not found",404);
        }
    }


    public function replace(ReplaceTicketRequest $request,$ticket_id)
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
