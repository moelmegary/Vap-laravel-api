<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthenticationController;
use App\Http\Controllers\api\ClientController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/register",[AuthenticationController::class,"createUser"]);
Route::post("/signin",[AuthenticationController::class,"signin"]); 
Route::get('/listUsers',[AuthenticationController::class,'listUser']);

                    // ClientRoute
Route::get('/listClient',[ClientController::class,'listClient']);
Route::post('/addClient',[ClientController::class,'addClient']);
Route::put('/updateClient/{id}',[ClientController::class,'updateClient']);
Route::delete('/deleteClient/{id}',[ClientController::class,'deleteClient']);
Route::post('/signinClient',[ClientController::class,'signinClient']);
