<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //index
    public function index(){
        return view('user.home');
    }
    //user list
    public function userList(){
        $userData = User::where('role','user')->paginate(5);
        return view('admin.user.userList')->with(['userData'=>$userData]);
    }

    //admin list
    public function adminList(){
        $adminData = User::where('role','admin')->paginate(5);
        return view('admin.user.adminList')->with(['adminData'=>$adminData]);
    }

    //search user
    public function searchUserList(Request $request){
        $response = $this->search($request,'user');
        return view('admin.user.userList')->with(['userData'=>$response]);
    }

    //search admin
    public function searchAdminList(Request $request){
        $response = $this->search($request,'admin');
        return view('admin.user.adminList')->with(['adminData'=>$response]);
    }

    //delete user and admin
    public function deleteUser($id){
        User::where('id',$id)->delete();
        return back()->with(['success'=>'User Account Deleted...']);
    }

    //get search data
    private function search($request,$role){
        $searchData = User::where('role',$role)->where(function($query) use ($request){
            $query->orWhere('name','like','%'.$request->search.'%')
                    ->orWhere('email','like','%'.$request->search.'%')
                    ->orWhere('phone','like','%'.$request->search.'%')
                    ->orWhere('address','like','%'.$request->search.'%');
        })->paginate(5);
        $searchData->appends($request->all());
        return $searchData;
    }
}