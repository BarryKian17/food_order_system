<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //User contact
    function contact(){
        return view('user.contact.contact');
    }

    //User message
    function contactMessage(Request $request){
       Contact::create([
        'name'=>$request->userName ,
        'email'=>$request->userEmail ,
        'message'=>$request->userMessage
       ]);

       return back()->with(['success'=>'Sent Message Successfully.We will contact back shortly.']);
    }


    //Admin side contact page
    function contactPage(){
        $message = Contact::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%')
            ->orWhere('email','like','%'.request('key').'%');
        })
        ->orderBy('created_at','asc')
        ->paginate(5);
        return view('admin.user.userContact',compact('message'));
    }

    //Contact Delete
    function contactDelete($id){
        Contact::where('id',$id)->delete();

        return back()->with(['delete'=>'Message Deleted!!!!']);
    }
}
