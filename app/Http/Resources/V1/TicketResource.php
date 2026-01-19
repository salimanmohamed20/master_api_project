<?php

namespace App\Http\Resources\V1;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Ticket */
class TicketResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            "type" => "ticket",
            "id" => $this->id,
            "attributes" => [
                "title" => $this->title,
                "description" => $this->when(
                    $request->routeIs("tickets.show"),
                    $this->description,
                ),
                "status" => $this->status,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ],
            'relationships' => $this->when(
                $request->routeIs("tickets.*"),
                [
                    'author' => [
                        'data' => [
                            'type' => 'user',
                            'id' => $this->user_id,
                        ],
                        'links' => [
                            'related' => route('authors.show', ['author' => $this->user_id]),
                        ],
                    ],
                ]
            ),
            'includes' =>
                 new UserResource($this->whenLoaded('author')),


            "links" => [
                "self" => route("tickets.show", ["ticket" => $this->id]),
            ],
        ];
    }
}
