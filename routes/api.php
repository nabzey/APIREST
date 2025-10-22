<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// API v1 Routes (sans authentification selon les spécifications)
Route::prefix('v1')->group(function () {

    // Routes pour les comptes bancaires
    Route::apiResource('comptes', \App\Http\Controllers\Api\V1\CompteController::class);

    // Routes pour les clients
    Route::apiResource('clients', \App\Http\Controllers\Api\V1\ClientController::class);
});
