<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\CategoryController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        if(Auth::check()){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin#index');
            }else if(Auth::user()->role == 'user'){
                return redirect()->route('user#index');
            }
        }
    })->name('dashboard');
});

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
   Route::get('/',[CategoryController::class,'index'])->name('admin#index');
   Route::get('profile',[CategoryController::class,'profile'])->name('admin#profile');

   Route::get('category',[CategoryController::class,'category'])->name('admin#category');
   Route::get('addCategory',[CategoryController::class,'addCategory'])->name('admin#addCategory');
   Route::post('createCategory',[CategoryController::class,'createCategory'])->name('admin#createCategory');
   Route::get('edit/{id}',[CategoryController::class,'editCategory'])->name('admin#editCategory');
   Route::post('update',[CategoryController::class,'updateCategory'])->name('admin#updateCategory');
   Route::get('deleteCategory/{id}',[CategoryController::class,'deleteCategory'])->name('admin#deleteCategory');
   Route::post('category',[CategoryController::class,'searchCategory'])->name('admin#searchCategory');

   Route::get('/pizza',[CategoryController::class,'pizza'])->name('admin#pizza');

});

Route::group(['prefix'=>'user'],function(){
    Route::get('/',[UserController::class,'index'])->name('user#index');
});