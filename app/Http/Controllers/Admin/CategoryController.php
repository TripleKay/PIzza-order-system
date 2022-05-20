<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    //category
    public function category(){
        //for csv download
        if(Session::has('CATEGORY_SEARCH')){
            Session::forget('CATEGORY_SEARCH');
        }

        $data = Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
                ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
                ->groupBy('categories.category_id')
                ->paginate(5);

        return view('admin.category.list')->with(['categories'=>$data]);
    }

    // view category item
    public function categoryItem($id){
        $data = Pizza::select('pizzas.*','categories.category_name as categoryName')
                ->leftJoin('categories','categories.category_id','pizzas.category_id')
                ->where('categories.category_id',$id)
                ->paginate(5);
        return view('admin.category.item')->with(['pizzas'=>$data]);
    }

    //searchcateogry
    public function searchCategory(Request $request){

        $data = Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
            ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
            ->where('categories.category_name','like','%'.$request->search.'%')
            ->groupBy('categories.category_id')
            ->paginate(5);

        Session::put('CATEGORY_SEARCH',$request->search);//for csv download

        $data->appends($request->all());//fixed search error when paginate
        return view('admin.category.list')->with(['categories'=>$data]);
    }

    //deletecategory
    public function deleteCategory($id){
        Category::where('category_id',$id)->delete();
        return back()->with(['success'=>'Category Deleted...']);
    }

    //updatecategory
    public function updateCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'categoryName'=> 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'category_name'=>$request->categoryName,
        ];
        Category::where('category_id',$request->id)->update($data);
        return redirect()->route('admin#category')->with(['success'=>'Category Updated....']);

    }

    //editcategory
    public function editCategory($id){
        $data = Category::where('category_id',$id)->first();
        return view('admin.category.editCategory')->with(['category'=>$data]);
    }

    //addcategory
     public function addCategory(){
        return view('admin.category.addCategory');
    }

    //createcategory
    public function createCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'categoryName'=> 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'category_name' =>  $request->categoryName,
        ];
        Category::create($data);
        return redirect()->route('admin#category')->with(['success'=>'Category Added.....']);
    }

    //download csv
    public function downloadCategory(){
        if(Session::has('CATEGORY_SEARCH')){
            // for search data
            $category = Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
                                ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
                                ->where('categories.category_name','like','%'.Session::get('CATEGORY_SEARCH').'%')
                                ->groupBy('categories.category_id')
                                ->get();
        }else{
            // for all data
            $category = Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
                        ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
                        ->groupBy('categories.category_id')
                        ->get();
        }

        $csvExporter = new \Laracsv\Export();

        $csvExporter->build($category, [
            'category_id' => 'ID',
            'category_name' => 'Category Name',
            'count' => 'Product Count',
            'created_at' => 'Created Date',
            'updated_at' => 'Updated Date'
        ]);

        $csvReader = $csvExporter->getReader();

        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'categoryList.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }


}