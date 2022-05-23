<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user list
    public function userList(){
        //for csv download
        if(Session::has('USER_SEARCH')){
            Session::forget('USER_SEARCH');
        }
        $userData = User::where('role','user')->paginate(5);
        return view('admin.user.userList')->with(['userData'=>$userData]);
    }

    //admin list
    public function adminList(){
        //for csv download
        if(Session::has('ADMIN_SEARCH')){
            Session::forget('ADMIN_SEARCH');
        }
        $adminData = User::where('role','admin')->paginate(5);
        return view('admin.user.adminList')->with(['adminData'=>$adminData]);
    }

    //search user
    public function searchUserList(Request $request){
        $response = $this->search($request->search,'user')->paginate(5);
        $response->appends($request->all());
        Session::put('USER_SEARCH',$request->search);//for csv download
        return view('admin.user.userList')->with(['userData'=>$response]);
    }

    //search admin
    public function searchAdminList(Request $request){
        $response = $this->search($request->search,'admin')->paginate(5);
        $response->appends($request->all());
        Session::put('ADMIN_SEARCH',$request->search);//for csv download
        return view('admin.user.adminList')->with(['adminData'=>$response]);
    }

    //download csv for user
    public function downloadUser(){
        $filename = 'userList.csv';
        return $this->downloadCSV('USER_SEARCH','user',$filename);
    }

    //download csv for admin
    public function downloadAdmin(){
        $filename = 'adminList.csv';
        return $this->downloadCSV('ADMIN_SEARCH','admin',$filename);
    }

    //delete user and admin
    public function deleteUser($id){
        User::where('id',$id)->delete();
        return back()->with(['success'=>'User Account Deleted...']);
    }

    //edit user and admin
    public function editUser($id){
        $data = User::where('id',$id)->first();
        return view('admin.user.edit')->with(['data'=>$data]);
    }

    //update user and admin
    public function updateUser(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'phone' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'address' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#userList')->with(['success'=>'user has been updated']);

    }

    //for download csv
    private function downloadCSV($sessionName,$role,$filename){
        if(Session::has($sessionName)){
            // for search data
            $data = $this->search(Session::get($sessionName),$role)->get();
        }else{
            // for all data
            $data = User::where('role',$role)->get();
        }

        $csvExporter = new \Laracsv\Export();

        $csvExporter->build($data, [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'role' => 'Role',
            'created_at' => 'Created Date',
            'updated_at' => 'Updated Date'
        ]);

        $csvReader = $csvExporter->getReader();

        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }


    //get request user data
    private function requestUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role
        ];
    }

    //get search data
    private function search($request,$role){
        $searchData = User::where('role',$role)->where(function($query) use ($request){
            $query->orWhere('name','like','%'.$request.'%')
                    ->orWhere('email','like','%'.$request.'%')
                    ->orWhere('phone','like','%'.$request.'%')
                    ->orWhere('address','like','%'.$request.'%');
        });
        return $searchData;
    }

}
