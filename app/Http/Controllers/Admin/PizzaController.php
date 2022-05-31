<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class PizzaController extends Controller
{
    //pizza
    public function pizza(){
        //for csv download
        if(Session::has('PIZZA_SEARCH')){
            Session::forget('PIZZA_SEARCH');
        }

        $data = Pizza::paginate(5);
        if( count($data) == 0){
            $emptyStatus = 0;
        }else{
            $emptyStatus = 1;
        }
        return view('admin.pizza.list')->with(['pizzas'=>$data,'emptyStatus' => $emptyStatus]);
   }

   //search pizza
   public function searchPizza(Request $request){
        $data = Pizza::orWhere('pizza_name','like','%'.$request->search.'%')
                        ->orWhere('price','like','%'.$request->search.'%')
                        ->paginate(5);

        $data->appends($request->all());//fixed search error when paginate

        if( count($data) == 0){
            $emptyStatus = 0;
        }else{
            $emptyStatus = 1;
        }

        Session::put('PIZZA_SEARCH',$request->search);//for csv download

        return view('admin.pizza.list')->with(['pizzas'=>$data,'emptyStatus' => $emptyStatus]);
   }

   //download csv
   public function downloadPizza(){
        if(Session::has('PIZZA_SEARCH')){
            // for search data
            $pizza = Pizza::orWhere('pizza_name','like','%'.Session::get('PIZZA_SEARCH').'%')
                            ->orWhere('price','like','%'.Session::get('PIZZA_SEARCH').'%')
                            ->get();
        }else{
            // for all data
            $pizza = Pizza::get();
        }

        $csvExporter = new \Laracsv\Export();

        $csvExporter->build($pizza, [
            'pizza_id' => 'ID',
            'pizza_name' => 'Pizza Name',
            'description' => 'Description',
            'price' => 'Price',
            'publish_status' => 'Publish Status',
            'buy_one_get_one_status' => 'Buy One Get One',
            'waiting_time' => 'Waiting Time',
            'discount_price' => 'Discount',
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

   //add pizza
   public function addPizza(){
       $data = Category::get();
       return view('admin.pizza.addPizza')->with(['categories'=>$data]);
   }

   //create pizza
   public function createPizza(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|dimensions:ratio=1/1',
            'price' => 'required',
            'publishStatus' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'buyOneGetOne' => 'required',
            'waitingTime' => 'required',
            'description' => 'required'
        ],[
            'image.dimensions' => 'Image ratio must be square.'
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $file = $request->file('image');
        $fileName = uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path().'/uploads/',$fileName);
        $data = $this->requestPizzaData($request,$fileName);
        Pizza::create($data);
        return redirect()->route('admin#pizza')->with(['success'=>'Pizza added...']);
   }

   //show pizza info
   public function infoPizza($id){
       $data = Pizza::where('pizza_id',$id)->first();
       return view('admin.pizza.infoPizza')->with(['pizza'=>$data]);
   }

   //edit pizza
   public function editPizza($id){
        $categories = Category::get();
        $data = Pizza::select('pizzas.*','categories.category_id','categories.category_name')
                ->join('categories','pizzas.category_id','=','categories.category_id')
                ->where('pizza_id',$id)
                ->first();
        return view('admin.pizza.editPizza')->with(['pizza'=>$data,'categories'=>$categories]);
   }

   //update pizza
   public function updatePizza($id,Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|dimensions:ratio=1/1',
            'price' => 'required',
            'publishStatus' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'buyOneGetOne' => 'required',
            'waitingTime' => 'required',
            'description' => 'required'
        ],[
            'image.dimensions' => 'Image ratio must be square.'
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $updateData = $this->requestUpdatePizzaData($request);

        if(isset($updateData['image'])){
            // delete old image
            $oldFile = Pizza::select('image')->where('pizza_id',$id)->first();
            $oldfileName = $oldFile['image'];
            if(File::exists(public_path().'/uploads/'.$oldfileName)){
                File::delete(public_path().'/uploads/'.$oldfileName);
            }

            //update new image
            $newFile = $request->image;
            $newFileName = uniqid().'_'.$newFile->getClientOriginalName();
            $newFile->move(public_path().'/uploads/',$newFileName);
            $updateData['image'] = $newFileName;

        }
        Pizza::where('pizza_id',$id)->update($updateData);
        return redirect()->route('admin#pizza')->with(['success'=>'Pizza Updated...']);

   }

   //delete pizza
   public function deletePizza($id){
       $data = Pizza::select('image')->where('pizza_id',$id)->first();
       $fileName = $data['image'];

       //delete from db
       Pizza::where('pizza_id',$id)->delete();

       //delete file from public folder
       if(File::exists(public_path().'/uploads/'.$fileName)){
            File::delete(public_path().'/uploads/'.$fileName);
       }

       return back()->with(['success'=>'Pizza Deleted...']);
   }

   //get request update pizza data
   private function requestUpdatePizzaData($request){
       $data = [
            'pizza_name' => $request->name,
            'price' => $request->price,
            'publish_status' => $request->publishStatus,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->buyOneGetOne,
            'waiting_time' => $request->waitingTime,
            'description' => $request->description
       ];
       if(isset($request->image)){
           $data['image'] = $request->image;
       }
       return $data;

   }

   //get request pizza data
   private function requestPizzaData($request,$fileName){
       return [
            'pizza_name' => $request->name,
            'image' => $fileName,
            'price' => $request->price,
            'publish_status' => $request->publishStatus,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->buyOneGetOne,
            'waiting_time' => $request->waitingTime,
            'description' => $request->description
       ];
   }
}