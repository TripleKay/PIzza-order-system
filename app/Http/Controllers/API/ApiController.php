<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ApiController extends Controller
{
    // category list
    public function category(){
        $category = Category::get();
        $response = [
            'status' => 200,
            'message' => "success",
            'data' => $category,
        ];
        return response()->json($response);
    }

    //create category
    public function createCategory(Request $request){
        $data = [
            'category_name' => $request->categoryName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        Category::create($data);

        $response = [
            'status' => 200,
            'message' => "success",
        ];
        return response()->json($response);
    }

    //detail category
    public function detailCategory($id){

       $category = Category::where('category_id',$id)->first();
       if(!empty($category)){//check category
           return response()->json([
               'status' => 200,
               'message' => 'success',
               'data' => $category
           ]);
       }

       return response()->json([
           'status' => 200,
           'message' => 'fail',
           'data' => $category
       ]);
    }

    //delete category
    public function deleteCategory($id){
        $category = Category::where('category_id',$id)->first();

        if(empty($category)){
            return response()->json([
                'status' => 200,
                'message' => 'There is no such data in table',
            ]);
        }

        Category::where('category_id',$id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'success',
        ]);
    }

    //update category
    public function updateCategory(Request $request){

        $updateData = [
            'category_id' => $request->id,
            'category_name' => $request->categoryName,
            'updated_at' => Carbon::now(),
        ];

        $category = Category::where('category_id',$request->id)->first();

        if(!empty($category)){
            Category::where('category_id',$request->id)->update($updateData);
            return response()->json([
                'status' => 200,
                'message' => 'success',
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'There is no such data',
        ]);
    }
}
