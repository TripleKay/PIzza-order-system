<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    //pizza
    public function pizza(){
        return view('admin.pizza.list');

   }
}