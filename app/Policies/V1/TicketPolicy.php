<?php

namespace App\Policies\V1;

use App\Http\Permissions\V1\Abilities;
use App\Models\User;
use App\Models\Ticket;



class TicketPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Ticket $ticket)
    {
        if($user->tokenCan(Abilities::UpdateTicket)){
            return true;
        }elseif($user->tokenCan(Abilities::UpdateOwnTicket)){
            return $user->id === $ticket->user_id;
        }

        return false;
    }


    public function store(User $user)
    {
        return $user->tokenCan(Abilities::CreateTicket)||
        $user->tokenCan(Abilities::CreateOwnTicket);
    }
}
