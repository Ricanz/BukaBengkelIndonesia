<?php

use App\Http\Controllers\Api\ClientController;
use Illuminate\Http\Request;
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
Route::get('/client/data', [ClientController::class, 'client_data']);
Route::get('/article/search', [ClientController::class, 'search']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
