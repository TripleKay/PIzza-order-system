<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    //order list
    public function orderList(){
        //for csv download
        if(Session::has('ORDER_SEARCH')){
            Session::forget('ORDER_SEARCH');
        }

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

        Session::put('ORDER_SEARCH',$request->search);//for csv download

        return view('admin.order.list')->with(['orders'=>$data,'emptyStatus'=>$emptyStatus]);

    }
    //download csv
    public function downloadOrder(){
        if(Session::has('ORDER_SEARCH')){
            // for search data
            $order = Order::select('orders.*','users.name as customer_name','pizzas.pizza_name as pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
                            ->join('users','users.id','orders.customer_id')
                            ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
                            ->orWhere('pizzas.pizza_name','like','%'.Session::get('ORDER_SEARCH').'%')
                            ->orWhere('users.name','like','%'.Session::get('ORDER_SEARCH').'%')
                            ->groupBy('orders.pizza_id','orders.customer_id')
                            ->get();
        }else{
            // for all data
            $order = Order::select('orders.*','users.name as customer_name','pizzas.pizza_name as pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
                    ->join('users','users.id','orders.customer_id')
                    ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
                    ->groupBy('orders.pizza_id','orders.customer_id')
                    ->get();
        }

        $csvExporter = new \Laracsv\Export();

        $csvExporter->build($order, [
            'order_id' => 'ID',
            'pizza_name' => 'Pizza Name',
            'customer_name' => 'Customer Name',
            'count' => 'Pizza Count',
            'order_time' => 'Order Date',
            'created_at' => 'Created Date',
            'updated_at' => 'Updated Date'
        ]);

        $csvReader = $csvExporter->getReader();

        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'pizzaList.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }

}