<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //profile
    public function profile(){
        $id = auth()->user()->id;
        $userData = User::where('id',$id)->first();
        return view('admin.profile.index')->with(['userData'=>$userData]);
    }

    //updateProfile
    public function updateProfile($id,Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address'=> 'required'
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = $this->getRequestUserData($request);
        User::where('id',$id)->update($data);
        return back()->with(['success'=>'User Data updated successfully......']);

    }

    //change password page
    public function changePasswordPage(){
        return view('admin.profile.changePassword');
    }

    //change password
    public function changePassword($id,Request $request){
        //check validation
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        //get request data
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        $confirmPassword = $request->confirmPassword;

        //get old password form db
        $data = User::where('id',$id)->first();
        $oldHashPassword = $data['password'];

        //check old password
        if(Hash::check($oldPassword, $oldHashPassword)){
            //check newPassword and confirmPassword are same
            if($newPassword != $confirmPassword){
                return back()->with(['notSameError'=>'confirm password and new password must be same?']);
            }else{
                //check new password length
                if( strlen($newPassword) <= 6 || strlen($confirmPassword) <= 6){
                    return back()->with(['lengthError'=>'password must be greather than 6 character']);
                }else{
                    //hash new password and update to db
                    $newPassword = Hash::make($newPassword);
                    User::where('id',$id)->update([
                        'password'=> $newPassword
                    ]);
                    return back()->with(['success'=>'Password Change...']);
                }
            }
        }else{
            return back()->with(['oldPassError'=>'Password do not match!Try Again...']);
        }
    }

    //get user data
    private function getRequestUserData($request){
        return [
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'address'=> $request->address
        ];
    }

}