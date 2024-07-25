<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProposalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->middleware(['throttle:api'])->group(function () {
    Route::post('register', [AuthController::class,'register']);
    Route::post('login', [AuthController::class,'login']);
});

Route::prefix('v1')->middleware(['throttle:api', 'auth:sanctum'])->group(function (){
    Route::apiResource('proposals', ProposalController::class);
    Route::get('logout', [AuthController::class,'logout']);
});