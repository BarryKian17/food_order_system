<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return Pizza list
    function pizzaList(Request $request){
        if($request->status == 'asc') {
            $data=Product::orderBy('price','asc')->get();
        } else {
            $data=Product::orderBy('price','desc')->get();
        }

        return response()->json($data,200);
    }

    //return pizza order
    function addToCart(Request $request){
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response = [
            'message'=> 'Add to Cart Complete',
            'status'=>'success'
        ];
        return response()->json($response,200);
    }

    //Order List
    function order(Request $request){
        $total = 0;
        foreach($request->all() as $item){
        $data = OrderList::create($item);

        $total += $data->total;
        }

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id'=>Auth::user()->id,
            'order_code'=>$data->order_code,
            'total_price'=> $total + 3000 ,

        ]);


        return response()->json([
            'status'=>'true' ,
            'message'=>'Order Complete'
        ],200);
    }

    //Cart Clear
    function cartClear(){
        Cart::where('user_id',Auth::user()->id)->delete();

    }

    //Clear Product
    function removeProduct(Request $request){
        Cart::where('user_id',Auth::user()->id)
        ->where('product_id',$request->productId)
        ->where('id',$request->orderId)
        ->delete();
    }

    //increase viewcount
    function viewCount(Request $request){
        $pizza = Product::where('id',$request->pizzaId)->first();
        $viewcount = [
            'view_count' => $pizza->view_count + 1
        ];

        Product::where('id',$request->pizzaId)->update($viewcount);

    }

    //pizza order data
    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ];
    }
}
