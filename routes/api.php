<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->post('/applications/{id}/status', [ApplicationController::class, 'updateStatus']);

