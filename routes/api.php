<?php

use App\Http\Controllers\API\EngineController;
use App\Http\Controllers\API\EngineTypeController;
use App\Http\Controllers\API\ManufacturerController;
use App\Http\Controllers\API\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('manufacturer', ManufacturerController::class);
    Route::resource('engine_type', EngineTypeController::class);
    Route::resource('engine', EngineController::class);
});
