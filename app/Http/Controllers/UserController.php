<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //index
    public function index(){
        $pizzas = Pizza::where('publish_status',1)->paginate(6);
        $categories = Category::get();
        $emptyStatus = count($pizzas) == 0 ? 0 : 1;
        return view('user.home')->with(['pizzas'=>$pizzas, 'categories'=>$categories,'emptyStatus'=>$emptyStatus]);
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

    //pizza Detail page
    public function pizzaDetail($id){
        $data = Pizza::where('pizza_id',$id)->first();
        Session::put('PIZZA_INFO',$data);//for order page
        return view('user.pizzaDetail')->with(['pizza'=>$data]);
    }

    //order
    public function order(){
        $pizzaInfo = Session::get('PIZZA_INFO');
        return view('user.order')->with(['pizza'=>$pizzaInfo]);
    }

    //place order
    public function placeOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'pizzaCount'=> 'required|numeric|min:1|max:10',
            'paymentType'=> 'required'
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $userId = auth()->user()->id;
        $pizzaInfo = Session::get('PIZZA_INFO');
        $pizzaCount = $request->pizzaCount;
        $orderData = $this->requestOrderData($pizzaInfo,$userId,$request);

        for( $i = 0; $i < $pizzaCount ; $i++ ){
            Order::create($orderData);
        }

        $waitingtime = $pizzaInfo['waiting_time'] * $pizzaCount;
        return back()->with(['totalTime'=>$waitingtime]);
    }

    //get order data
    public function requestOrderData($pizzaInfo,$userId,$request){
        return [
            'customer_id'=> $userId,
            'pizza_id' => $pizzaInfo['pizza_id'],
            'carrier_id' => 0,
            'payment_status' => $request->paymentType,
            'order_time' => Carbon::now()
        ];
    }
}