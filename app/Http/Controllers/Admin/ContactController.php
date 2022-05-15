<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //create contact from user or customer
    public function createContact(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $this->getContactData($request);
        Contact::create($data);
        return back()->with(['success'=>'sending message successfully']);
    }

    //contact list
    public function contactList(){
        $data = Contact::orderBy('contact_id','desc')->paginate(5);
        if(count($data) == 0){
            $emptyStatus = 0;
        }else{
            $emptyStatus = 1;
        }
        return view('admin.contact.list')->with(['data'=>$data,'emptyStatus' => $emptyStatus]);
    }

    //serach contact
    public function searchContact(Request $request){
        $data = Contact::orWhere('name','like','%'.$request->search.'%')
                                ->orWhere('email','like','%'.$request->search.'%')
                                ->orWhere('message','like','%'.$request->search.'%')
                                ->paginate(5);
        $data->appends($request->all());
        if(count($data) == 0){
            $emptyStatus = 0;
        }else{
            $emptyStatus = 1;
        }
        return view('admin.contact.list')->with(['data'=>$data,'emptyStatus' => $emptyStatus]);
    }

    //get contact data
    private function getContactData($request){
        return [
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
    }
}