<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::ApiResource('/tickets', \App\Http\Controllers\Api\V1\TicketController::class);
Route::ApiResource('/users', \App\Http\Controllers\Api\V1\UserController::class);
