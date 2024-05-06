<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthenticationController;
use App\Http\Controllers\api\ClientController;
use App\Http\Controllers\api\CafeController;
use App\Http\Controllers\api\TableController;
use App\Http\Controllers\api\HotelController;
use App\Http\Controllers\api\VacationController;
use App\Http\Controllers\api\CarController;
use App\Http\Controllers\api\PlaneController;
use App\Http\Controllers\api\HotelOrderController;
use App\Http\Controllers\api\CarOrderController;
use App\Http\Controllers\api\TableOrderController;








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


                    // CafeRoute
Route::get('/listCafe',[CafeController::class,'listCafe']);
Route::post('/addCafe',[CafeController::class,'addCafe']);
Route::post('/updateCafe/{id}',[CafeController::class,'updateCafe']);
Route::delete('/deleteCafe/{id}',[CafeController::class,'deleteCafe']);


                    // TableRoute
Route::get('/listTable/{id}',[TableController::class,'listTable']);
Route::post('/addTable',[TableController::class,'addTable']);
Route::post('/updateTable/{id}',[TableController::class,'updateTable']);
Route::delete('/deleteTable/{id}',[TableController::class,'deleteTable']);

                    // HotelRoute
Route::get('/listHotel',[HotelController::class,'listHotel']);
Route::post('/addHotel',[HotelController::class,'addHotel']);
Route::post('/updateHotel/{id}',[HotelController::class,'updateHotel']);
Route::delete('/deleteHotel/{id}',[HotelController::class,'deleteHotel']);

                    // VacationRoute
Route::get('/listVacation',[VacationController::class,'listVacation']);
Route::post('/addVacation',[VacationController::class,'addVacation']);
Route::post('/updateVacation/{id}',[VacationController::class,'updateVacation']);
Route::delete('/deleteVacation/{id}',[VacationController::class,'deleteVacation']);

                    // CarRoute
Route::get('/listCar',[CarController::class,'listCar']);
Route::post('/addCar',[CarController::class,'addCar']);
Route::post('/updateCar/{id}',[CarController::class,'updateCar']);
Route::delete('/deleteCar/{id}',[CarController::class,'deleteCar']);

                    // PlaneRoute
Route::get('/listPlane',[PlaneController::class,'listPlane']);
Route::post('/addPlane',[PlaneController::class,'addPlane']);
Route::post('/updatePlane/{id}',[PlaneController::class,'updatePlane']);
Route::delete('/deletePlane/{id}',[PlaneController::class,'deletePlane']);

                    // HotelOrderRoute
 Route::get('/listHotelOrder',[HotelOrderController::class,'listHotelOrder']);
 Route::post('/addHotelOrder',[HotelOrderController::class,'addHotelOrder']);
 Route::post('/updateHotelOrder/{id}',[HotelOrderController::class,'updateHotelOrder']);
 Route::delete('/deleteHotelOrder/{id}',[HotelOrderController::class,'deleteHotelOrder']);

                     // CarOrderRoute
Route::get('/listCarOrder',[CarOrderController::class,'listCarOrder']);
Route::post('/addCarOrder',[CarOrderController::class,'addCarOrder']);
Route::post('/updateCarOrder/{id}',[CarOrderController::class,'updateCarOrder']);
Route::delete('/deleteCarOrder/{id}',[CarOrderController::class,'deleteCarOrder']);

                    // TableOrderRoute
Route::get('/listTableOrder',[TableOrderController::class,'listTableOrder']);
Route::post('/addTableOrder',[TableOrderController::class,'addTableOrder']);
Route::post('/updateTableOrder/{id}',[TableOrderController::class,'updateTableOrder']);
Route::delete('/deleteTableOrder/{id}',[TableOrderController::class,'deleteTableOrder']);


