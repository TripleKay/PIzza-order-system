<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PizzaController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Http\Middleware\UserCheckMiddleware;

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
                return redirect()->route('admin#profile');
            }else if(Auth::user()->role == 'user'){
                return redirect()->route('user#index');
            }
        }
    })->name('dashboard');
});

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>[AdminCheckMiddleware::class]],function(){
   Route::get('profile',[AdminController::class,'profile'])->name('admin#profile');
   Route::post('updateProfile/{id}',[AdminController::class,'updateProfile'])->name('admin#updateProfile');
   Route::get('changePassword',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
   Route::post('changePassword/{id}',[AdminController::class,'changePassword'])->name('admin#changePassword');

   Route::get('category',[CategoryController::class,'category'])->name('admin#category');
   Route::get('addCategory',[CategoryController::class,'addCategory'])->name('admin#addCategory');
   Route::post('createCategory',[CategoryController::class,'createCategory'])->name('admin#createCategory');
   Route::get('edit/{id}',[CategoryController::class,'editCategory'])->name('admin#editCategory');
   Route::post('update',[CategoryController::class,'updateCategory'])->name('admin#updateCategory');
   Route::get('deleteCategory/{id}',[CategoryController::class,'deleteCategory'])->name('admin#deleteCategory');
   Route::get('category/search',[CategoryController::class,'searchCategory'])->name('admin#searchCategory');
   Route::get('categoryItem/{id}',[CategoryController::class,'categoryItem'])->name('admin#categoryItem');
   Route::get('downloadCategory',[CategoryController::class,'downloadCategory'])->name('admin#downloadCategory');

   Route::get('pizza',[PizzaController::class,'pizza'])->name('admin#pizza');
   Route::get('addPizza',[PizzaController::class,'addPizza'])->name('admin#addPizza');
   Route::post('createPizza',[PizzaController::class,'createPizza'])->name('admin#createPizza');
   Route::get('deletePizza/{id}',[PizzaController::class,'deletePizza'])->name('admin#deletePizza');
   Route::get('infoPizza/{id}',[PizzaController::class,'infoPizza'])->name('admin#infoPizza');
   Route::get('editPizza/{id}',[PizzaController::class,'editPizza'])->name('admin#editPizza');
   Route::post('updatePizza/{id}',[PizzaController::class,'updatePizza'])->name('admin#updatePizza');
   Route::get('pizza/search',[PizzaController::class,'searchPizza'])->name('admin#searchPizza');
   Route::get('downloadPizza',[PizzaController::class,'downloadPizza'])->name('admin#downloadPizza');

   Route::get('userList',[UserController::class,'userList'])->name('admin#userList');
   Route::get('adminList',[UserController::class,'adminList'])->name('admin#adminList');
   Route::get('userList/search',[UserController::class,'searchUserList'])->name('admin#searchUserList');
   Route::get('adminList/search',[UserController::class,'searchAdminList'])->name('admin#searchAdminList');
   Route::get('deleteUser/{id}',[UserController::class,'deleteUser'])->name('admin#deleteUser');
   Route::get('editUser/{id}',[UserController::class,'editUser'])->name('admin#editUser');
   Route::post('updateUser/{id}',[UserController::class,'updateUser'])->name('admin#updateUser');
   Route::get('downloadUser',[UserController::class,'downloadUser'])->name('admin#downloadUser');
   Route::get('downloadAdmin',[UserController::class,'downloadAdmin'])->name('admin#downloadAdmin');

   Route::get('contactList',[ContactController::class,'contactList'])->name('admin#contactList');
   Route::get('contactList/search',[ContactController::class,'searchContact'])->name('admin#searchContact');
   Route::get('downloadContact',[ContactController::class,'downloadContact'])->name('admin#downloadContact');

   Route::get('order/list',[OrderController::class,'orderList'])->name('admin#orderList');
   Route::get('order/list/search',[OrderController::class,'searchOrder'])->name('admin#searchOrder');
   Route::get('downloadOrder',[OrderController::class,'downloadOrder'])->name('admin#downloadOrder');
});

Route::group(['prefix'=>'user','middleware'=>[UserCheckMiddleware::class]],function(){
    Route::get('/',[App\Http\Controllers\UserController::class,'index'])->name('user#index');
    Route::get('pizza/detail/{id}',[App\Http\Controllers\UserController::class,'pizzaDetail'])->name('user#pizzaDetail');
    Route::post('category/search/',[App\Http\Controllers\UserController::class,'searchCategory'])->name('user#searchCategory');
    Route::get('search/item',[App\Http\Controllers\UserController::class,'searchPizza'])->name('user#searchPizza');
    Route::get('search/pizzaItem',[App\Http\Controllers\UserController::class,'searchPizzaItem'])->name('user#searchPizzaItem');

    Route::post('contact/create/',[ContactController::class,'createContact'])->name('user#createContact');

    Route::get('order',[App\Http\Controllers\UserController::class,'order'])->name('user#order');
    Route::post('order',[App\Http\Controllers\UserController::class,'placeOrder'])->name('user#placeOrder');
});