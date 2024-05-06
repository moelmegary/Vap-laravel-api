<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\OfferController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//get method law msh hab3at data
Route::get('/mo', function () {
    return 'welcome';
});
//route parameter two types -requierd -not requierd
//required parameter
Route::get('/sona/{id}',function() {
    return 'hi sona'; 
});
//not required parameter
Route::get('/omar/{id?}', function () {
    return 'welcome';
});
//route name
Route::get('/baba/{id}',function() {
    return 'hi dad'; 
})->name('tamer');
//prefix magmo3a feha 7aga moshtarka
Route::prefix('/user')->group(function(){

    Route::get('/po',function(){
return 'prefix po';
    });
    Route::get('/fo',function(){
        return 'prefix fo';
    });
 
});
//group of set of routes
Route::group(['prefix'=>'/group'],function(){
//set of routes

Route::get('/po',function(){
    return 'group po';
        });
});
//middleware two syntax 
//first
Route::group(['middleware'=>'auth'],function(){

Route::get('/so',function(){

return 'middleware mo';
});
});
/*
//route of firstController
//Route::get('first','firstController@showm');
*/
Route::resource('news','App\Http\Controllers\newsController');
Route::get('/roro','App\Http\Controllers\newsController@getview');
Route::get('/fillable' ,'App\Http\Controllers\OfferController@offerShow');

