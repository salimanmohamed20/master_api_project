<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\V1\TicketFilter;
use App\Http\Requests\Api\V1\TicketRequest;
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

$user=User::findOrFail($request->input('data.relationships.author.data.id'));
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

    public function show(Ticket $ticket)
    {
        if($this->include('author')){
            return new TicketResource($ticket->load('author'));
        }
        return new TicketResource($ticket);
    }

    public function update(TicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->validated());

        return new TicketResource($ticket);
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return response()->json();
    }
}
