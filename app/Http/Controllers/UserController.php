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

    //search By price
    public function searchPizzaItem(Request $request){

        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        $query = Pizza::select('*');

        //for date
        if(!is_null($startDate) && is_null($endDate)){
            //have startDate
            $query->whereDate('created_at','>=',$startDate);
        }else if(is_null($startDate) && !is_null($endDate)){
            //have endDate
            $query->whereDate('created_at','<=',$endDate);
        }else if(!is_null($startDate) && !is_null($endDate)){
            //have both
            $query->whereDate('created_at','>=',$startDate)
                    ->whereDate('created_at','<=',$endDate);
        }

        //for price
        if(!is_null($minPrice) && is_null($maxPrice)){
            //have minPrice
            $query->where('price','>=',$minPrice);
        }else if(is_null($minPrice) && !is_null($maxPrice)){
            //have maxPrice
            $query->where('price','<=',$maxPrice);
        }else if(!is_null($minPrice) && !is_null($maxPrice)){
            //have both
            $query->where('price','>=',$minPrice)
                    ->where('price','<=',$maxPrice);
        }

        $query = $query->paginate(6);
        $query->appends($request->all());

        $emptyStatus = count($query ) == 0 ? 0 : 1;
        $categories = Category::get();

        return view('user.home')->with(['pizzas'=>$query, 'categories'=>$categories,'emptyStatus'=>$emptyStatus]);
   }
}
