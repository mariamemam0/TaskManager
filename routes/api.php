<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('projects',\App\Http\Controllers\ProjectController::class);
Route::apiResource('tasks',\App\Http\Controllers\TaskController::class);
