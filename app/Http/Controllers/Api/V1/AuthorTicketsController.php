<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\V1\TicketFilter;
use App\Http\Resources\V1\TicketResource;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Api\V1\TicketRequest;

class AuthorTicketsController extends Controller
{
    public function index($author_id,TicketFilter $filters)
    {
        return TicketResource::collection(Ticket::where('user_id', $author_id)->filter($filters)->paginate());

    }

     public function store($author_id,TicketRequest $request)
    {
        
        
        return new TicketResource(Ticket::create([
            'user_id' => $author_id,
            'title' => $request->input('data.attributes.title'),
            'description' => $request->input('data.attributes.description'),
            'status' => $request->input('data.attributes.status'),
        ]));

  
    }
}
