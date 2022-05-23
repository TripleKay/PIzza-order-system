<?php

use App\Http\Controllers\API\ApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'category','namespace'=>'API'],function(){
    Route::get('list',[ApiController::class,'category']);
    Route::post('create',[ApiController::class,'createCategory']);
    Route::get('detail/{id}',[ApiController::class,'detailCategory']);
    Route::get('delete/{id}',[ApiController::class,'deleteCategory']);
    Route::post('update',[ApiController::class,'updateCategory']);
});