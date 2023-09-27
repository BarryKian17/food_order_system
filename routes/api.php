<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RouteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//   http://127.0.0.1:8000/api/product/list
Route::get('product/list',[RouteController::class,'productList']);
// ...

// http://127.0.0.1:8000/api/category/list   [can add id for each category]
Route::get('category/list',[RouteController::class,'categoryList']);
Route::get('category/list/{id}',[RouteController::class,'categoryDetail']);
// ...

//  http://127.0.0.1:8000/api/user/list
Route::get('user/list',[RouteController::class,'userList']);
// ...

//  http://127.0.0.1:8000/api/order/list
Route::get('order/list',[RouteController::class,'orderList']);
// ...

//  http://127.0.0.1:8000/api/orderList/list
Route::get('orderList/list',[RouteController::class,'orderListDetail']);
// ...

http://127.0.0.1:8000/api/contact/list
Route::get('contact/list',[RouteController::class,'contactList']);
// ...

//  http://127.0.0.1:8000/api/create/category
// name => name
Route::post('create/category',[RouteController::class,'categoryCreate']);
// ...

//  http://127.0.0.1:8000/api/create/contact
// name =>name  |  email=>email  |  message=>message
Route::post('create/contact',[RouteController::class,'contactCreate']);
// ...

//  http://127.0.0.1:8000/api/delete/category
// id=>category_id
Route::post('delete/category',[RouteController::class,'categoryDelete']);
// ...

//  http://127.0.0.1:8000/api/category/update
//  id=>category_id  |  name=>category_name
Route::post('category/update',[RouteController::class,'categoryUpdate']);
// ...
