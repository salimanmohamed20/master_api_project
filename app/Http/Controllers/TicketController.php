<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        return TicketResource::collection(Ticket::all());
    }

    public function store(TicketRequest $request)
    {
        return new TicketResource(Ticket::create($request->validated()));
    }

    public function show(Ticket $ticket)
    {
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
