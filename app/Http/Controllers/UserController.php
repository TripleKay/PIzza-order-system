<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Pizza;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //index
    public function index(){
        $pizzas = Pizza::where('publish_status',1)->paginate(6);
        $categories = Category::get();
        $emptyStatus = count($pizzas) == 0 ? 0 : 1;
        return view('user.home')->with(['pizzas'=>$pizzas, 'categories'=>$categories,'emptyStatus'=>$emptyStatus]);
    }

    //pizza Detail page
    public function pizzaDetail($id){
        $data = Pizza::where('pizza_id',$id)->first();
        return view('user.pizzaDetail')->with(['data'=>$data]);
    }

    //search Pizza
    public function searchPizza(Request $request){
        $pizzas = Pizza::where('publish_status',1)->where('pizza_name','like','%'.$request->search.'%')->paginate(6);
        $categories = Category::get();
        $emptyStatus = count($pizzas) == 0 ? 0 : 1;
        $pizzas->appends($request->all());
        return view('user.home')->with(['pizzas'=>$pizzas, 'categories'=>$categories,'emptyStatus'=>$emptyStatus]);
    }

    //search Category
    public function searchCategory($id){
        $pizzas = Pizza::where('publish_status',1)->where('category_id',$id)->paginate(6);
        $categories = Category::get();
        $emptyStatus = count($pizzas) == 0 ? 0 : 1;
        return view('user.home')->with(['pizzas'=>$pizzas, 'categories'=>$categories,'emptyStatus'=>$emptyStatus]);
    }
}