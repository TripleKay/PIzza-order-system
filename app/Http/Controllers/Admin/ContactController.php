<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
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
        //for csv download
        if(Session::has('CONTACT_SEARCH')){
            Session::forget('CONTACT_SEARCH');
        }

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

        Session::put('CONTACT_SEARCH',$request->search);//for csv download

        return view('admin.contact.list')->with(['data'=>$data,'emptyStatus' => $emptyStatus]);
    }

    //download csv
    public function downloadContact(){
        if(Session::has('CONTACT_SEARCH')){
            // for search data
            $contact = Contact::orWhere('name','like','%'.Session::get('CONTACT_SEARCH').'%')
                                    ->orWhere('email','like','%'.Session::get('CONTACT_SEARCH').'%')
                                    ->orWhere('message','like','%'.Session::get('CONTACT_SEARCH').'%')
                                    ->get();
        }else{
            // for all data
            $contact = Contact::orderBy('contact_id','desc')->get();
        }

        $csvExporter = new \Laracsv\Export();

        $csvExporter->build($contact, [
            'contact_id' => 'ID',
            'name' => 'Name',
            'user_id' => 'User id',
            'email' => 'Email',
            'message' => 'Message',
            'created_at' => 'Created Date',
            'updated_at' => 'Updated Date'
        ]);

        $csvReader = $csvExporter->getReader();

        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'contactList.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
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
