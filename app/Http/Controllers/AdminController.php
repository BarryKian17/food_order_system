<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change password page
    function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
       $dbHashValue = $user->password;
       if(Hash::check($request->oldPassword, $dbHashValue)){
        $data = [
            'password'=>Hash::make($request->newPassword)
        ];
        User::where('id',Auth::user()->id)->update($data);

        return back()->with(['changeSuccess'=>'Password is Changed']);

       }
       return back()->with(['notMatch'=>'The old password do not match']);
    }

    //Account details page
    function details(){
        return view('admin.account.detail');
    }

    //Account Edit
    function edit(){
        return view('admin.account.edit');
    }

    //Account Update
    function update($id,Request $request){
       $this->accountValidationCheck($request);
       $data = $this->getUserData($request);

        //For Image
        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAS('public',$fileName);
            $data['image'] = $fileName;
        }

       User::where('id',$id)->update($data);
       return redirect()->route('admin#details')->with(['updateSuccess'=>'Profile info successfully updated']);
    }

    //Admin List
    function list(){
        $admin = User::where('role','admin')->when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%')
                  ->orWhere('email','like','%'.request('key').'%')
                  ->orWhere('phone','like','%'.request('key').'%')
                  ->orWhere('address','like','%'.request('key').'%');
        })->paginate(4);

        return view('admin.account.list',compact('admin'));
    }

    //Admin delete
    function delete($id){
       User::where('id',$id)->delete();
       return redirect()->route('admin#list')->with(['deleteSuccess'=>'Admin account deleted']);
    }

    //Admin Role change
    function changeRole($id){
        $account = User::where('id',$id)->first();
         return view('admin.account.changeRole',compact('account'));
    }
    function change($id,Request $request){
        $data = $this->changeAccountRole($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list')->with(['changeSuccess'=>'Accout Role change Success.']);
    }



    //Account Role Change
    private function changeAccountRole($request){
        return[
            'role'=>$request->role
        ];
    }

    //Account update validation
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:users,email,'.Auth::user()->id,
            'phone'=>'required',
            'image'=>'mimes:png,jpg,jpeg,avif|file',
            'gender'=>'required',
            'address'=>'required',
        ])->validate();
    }

    //Account info update
    private function getUserData($request){
        return[
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'updated_at'=>Carbon::now(),

        ];
    }

    //validate password
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:8',
            'newPassword'=>'required|min:8',
            'confirmPassword'=>'required|min:8|same:newPassword',
        ])->validate();
    }
}
