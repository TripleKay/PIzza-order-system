<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //order list
    public function orderList(){
        $data = Order::select('orders.*','users.name as customer_name','pizzas.pizza_name as pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
                    ->join('users','users.id','orders.customer_id')
                    ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
                    ->groupBy('orders.pizza_id','orders.customer_id')
                    ->paginate(5);
        if( count($data) == 0){
            $emptyStatus = 0;
        }else{
            $emptyStatus = 1;
        }

        return view('admin.order.list')->with(['orders'=>$data,'emptyStatus'=>$emptyStatus]);
    }

    //search order
    public function searchOrder(Request $request){
        $data = Order::select('orders.*','users.name as customer_name','pizzas.pizza_name as pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
                    ->join('users','users.id','orders.customer_id')
                    ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
                    ->orWhere('pizzas.pizza_name','like','%'.$request->search.'%')
                    ->orWhere('users.name','like','%'.$request->search.'%')
                    ->groupBy('orders.pizza_id','orders.customer_id')
                    ->paginate(5);

        $data->appends($request->all());

        if( count($data) == 0){
            $emptyStatus = 0;
        }else{
            $emptyStatus = 1;
        }

        return view('admin.order.list')->with(['orders'=>$data,'emptyStatus'=>$emptyStatus]);

    }
}