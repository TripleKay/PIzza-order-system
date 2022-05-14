<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //index
    public function index(){
        $pizzas = Pizza::where('publish_status',1)->get();
        return view('user.home')->with(['pizzas'=>$pizzas]);
    }
}