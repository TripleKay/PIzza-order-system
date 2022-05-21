<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
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
            $query->orWhere('name','like','%'.$request->search.'%')
                    ->orWhere('email','like','%'.$request->search.'%')
                    ->orWhere('phone','like','%'.$request->search.'%')
                    ->orWhere('address','like','%'.$request->search.'%');
        })->paginate(5);
        $searchData->appends($request->all());
        return $searchData;
    }
}
