<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct Order list page
    function orderList(){
        $order = Order::select('orders.*','users.name as user_name')

        ->leftJoin('users','orders.user_id','users.id')
        ->when(request('key'),function($query){
            $query->where('user_id','like','%'.request('key').'%')
                  ->orWhere('order_code','like','%'.request('key').'%');
            })
        ->orderBy('created_at','desc')
        ->paginate('6');
        $order->appends(request()->all());
        return view('admin.order.list',compact('order'));

    }


    //Sorting with Status
    function changeStatus(Request $request){
        $order = Order::select('orders.*','users.name as user_name')

        ->leftJoin('users','orders.user_id','users.id')
        ->when(request('key'),function($query){
            $query->where('user_id','like','%'.request('key').'%')
                  ->orWhere('order_code','like','%'.request('key').'%');
            })
        ->orderBy('created_at','desc');
        if($request->orderStatus == null){
            $order = $order->paginate('6');
        }else{
            $order = $order->where('status',$request->orderStatus)->paginate('6');
        }

        return view('admin.order.list',compact('order'));
    }

    //Status Change
    function statusChange(Request $request){
        Order::where('id',$request->orderId)->update([
            'status'=>$request->status
        ]);
    }


    //List info
    function listInfo($orderCode){
       $orderList = OrderList::select('order_lists.*','products.name as product_name','products.image as product_image','products.price as price','users.name as user_name')
       ->leftJoin('users','order_lists.user_id','users.id')
       ->leftJoin('products','order_lists.product_id','products.id')
       ->where('order_code',$orderCode)
       ->get();

       $totalPrice = Order::where('order_code',$orderCode)->get();

        return view('admin.order.productList',compact('orderList','orderCode','totalPrice'));
    }
}
