<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //index
    public function index(){
        return view('user.home');
    }
}