<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{



    //direct login page
    function loginPage() {
        return view('login');
    }

    //direct register page
    function registerPage() {
        return view('register');
    }


     //dashboard
     function dashboard(){
        if(Auth::user()->role =='admin'){
            return redirect()->route('category#list');
        }
            return redirect()->route('user#home');
        }



}
