<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{

//Data Base List api get start
    //Product list
    function productList(){
        $data = Product::get();
        return response()->json($data, 200);
    }

    //User list
    function userList(){
       $admin = User::where('role','admin')->get();
       $user = User::where('role','user')->get();

       $data = [
        'admin'=> [
            'admin'=> $admin
        ],
        'user'=>$user
       ];
        return response()->json($data, 200);
    }

    //Order list
    function orderList(){
        $data = Order::get();
        return response()->json($data, 200);
    }

    //OrderList list
    function orderListDetail(){
        $data = OrderList::get();
        return response()->json($data, 200);
    }

    //Category list
    function categoryList(){
        $data = Category::get();
        return response()->json($data, 200);
    }

    //Contact list
    function contactList(){
        $data = Contact::get();
        return response()->json($data, 200);
    }
//Data Base List api get end



   //Category list Create
    function categoryCreate(Request $request){
       $data = [
        'name'=>$request->name ,
        'created_at'=> Carbon::now(),
        'updated_at'=> Carbon::now(),
       ];

      $response = Category::create($data);
      return response()->json($data, 200);
    }

    //contact list Create
    function contactCreate(Request $request){
         $data = [
            'name'=>$request->name ,
            'email'=>$request->email ,
            'message'=>$request->message ,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ];

        $response = Contact::create($data);
        return response()->json($data, 200);
        }

    //Delete Category
    function categoryDelete(Request $request){
        $data = Category::where('id',$request->category_id)->first();
        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
            return response()->json(['status'=> true,'message'=>"delete success",'deleted'=>$data], 200);
        } else{
            return response()->json(['status'=> false,'message'=>"Id not found"], 200);
        }
    }


    //Category Details
    function categoryDetail($id){
        $data = Category::where('id',$id)->first();

        if(isset($data)){

            return response()->json(['status'=> true,'category'=>$data],200);
        }else {
            return response()->json(['status'=> false,'message'=>'Id not found'],200);

        }
    }

    //Update Category
    function categoryUpdate(Request $request){
        $categoryId = $request->category_id;
        $data = [
            'name'=>$request->category_name ,

            'updated_at'=>Carbon::now()
        ];
        $dbSource = Category::where('id',$categoryId)->first();

        if(isset($dbSource)){
           Category::where('id',$categoryId)->update($data);
            return response()->json(['message'=>'Update Success','Updated Data'=>$data] , 200);
        } else{
            return response()->json(['message'=>'Id not found'], 200,);
        }

    }
}
