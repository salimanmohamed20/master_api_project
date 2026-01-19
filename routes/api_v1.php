<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::ApiResource('/tickets', \App\Http\Controllers\Api\V1\TicketController::class)->except(['update']);
Route::put('/tickets/{ticket}',[\App\Http\Controllers\Api\V1\TicketController::class,'replace']);

Route::ApiResource('/authors', \App\Http\Controllers\Api\V1\AuthorsController::class);
Route::ApiResource("authors.tickets", \App\Http\Controllers\Api\V1\AuthorTicketsController::class)->except(['update']);
Route::put('/authors/{author}/tickets/{ticket}',[\App\Http\Controllers\Api\V1\AuthorTicketsController::class,'replace']);

