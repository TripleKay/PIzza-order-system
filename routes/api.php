<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\ApiController;

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

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::group(['prefix'=>'category','namespace'=>'API','middleware'=>'auth:sanctum'],function(){
    Route::get('list',[ApiController::class,'category']);
    Route::post('create',[ApiController::class,'createCategory']);
    Route::get('detail/{id}',[ApiController::class,'detailCategory']);
    Route::get('delete/{id}',[ApiController::class,'deleteCategory']);
    Route::post('update',[ApiController::class,'updateCategory']);
});

Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::get('logout',[AuthController::class,'logout']);
});