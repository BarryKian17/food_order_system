<?php

namespace App\Http\Controllers\User;

use Storage;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //User Home page
    function home(){
        $pizza = Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //Password change Page
    function changePage(){
        return view('user.main.change');
    }

    //User Password Change
    function updatePassword(Request $request){
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
       $dbHashValue = $user->password;
       if(Hash::check($request->oldPassword, $dbHashValue)){
        $data = [
            'password'=>Hash::make($request->newPassword)
        ];
        User::where('id',Auth::user()->id)->update($data);

        return back()->with(['changeSuccess'=>'Password Change Success...']);

       }
       return back()->with(['notMatch'=>'The old password do not match']);
    }

    //Account info
    function accountPage(){
        return view('user.profile.account');
    }
    //Account Edit Page
    function editPage(){
        return view('user.profile.userEdit');
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
       return redirect()->route('user#accountPage')->with(['updateSuccess'=>'Profile info successfully updated']);
    }

    //Pizza Filter
    function filter($categoryId){
       $pizza = Product::where('category_id',$categoryId)->orderby('created_at','desc')->get();
       $category = Category::get();
       $cart = Cart::where('user_id',Auth::user()->id)->get();
       $history = Order::where('user_id',Auth::user()->id)->get();

       return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //Direct Pizza details
    function pizzaDetails($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.detail',compact('pizza','pizzaList'));
    }

    //Cart List
    function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
        ->leftJoin('products','carts.product_id','products.id')
        ->where('user_id',Auth::user()->id)
        ->get();

        $totalPrice = 0;
        foreach($cartList as $c){
            $totalPrice += $c->pizza_price * $c->qty;
        }

        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    //Cart History
    function cartHistory(){
        $order = Order::where('user_id',Auth::user()->id)
        ->orderBy('id','desc')
        ->paginate('6');

        return view('user.main.history',compact('order'));
    }

     //Direct user list
     function userList(){
        $userList =User::where('role','user')->when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%')
                  ->orWhere('email','like','%'.request('key').'%')
                  ->orWhere('phone','like','%'.request('key').'%')
                  ->orWhere('address','like','%'.request('key').'%');
        })->paginate(4);
        return view('admin.user.userList',compact('userList'));
    }

    //User Role change
    function userRoleChange(Request $request){
        $updateRole = [
            'role' => $request->role
        ];
        User::where('id',$request->userId)->update($updateRole);

    }

    //User delete
    function userDelete($id){
        User::where('id',$id)->delete();
        Order::where('user_id',$id)->delete();
        OrderList::where('user_id',$id)->delete();
        Cart::where('user_id',$id)->delete();
        return redirect()->route('admin#userList')->with(['deleteSuccess'=>'User account deleted']);
     }





    //validate password
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:8',
            'newPassword'=>'required|min:8',
            'confirmPassword'=>'required|min:8|same:newPassword',
        ])->validate();
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
}
