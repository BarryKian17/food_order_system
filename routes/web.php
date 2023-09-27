<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;




// test
// Route::get('/test', function () {
//     return view('testlogin');
// });




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|AA00C2O52T
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great */

// Login/Register

Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/','loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {

//dashboard
Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');


// Admin
Route::middleware(['admin_auth'])->group(function(){

    //category
    Route::prefix('category')->group(function(){
        Route::get('list',[CategoryController::class,'list'])->name('category#list');
        Route::get('createPage',[CategoryController::class,'createPage'])->name('category#createPage');
        Route::post('create',[CategoryController::class,'create'])->name('category#create');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
        Route::post('update',[CategoryController::class,'update'])->name('category#update');
});
    //Admin Account
    Route::prefix('admin')->group(function(){
        //Password
        Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
        Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

        //Account info
        Route::get('details',[AdminController::class,'details'])->name('admin#details');
        Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
        Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

        //Admin List
        Route::get('list',[AdminController::class,'list'])->name('admin#list');
        Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
        Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
        Route::post('change/{id}',[AdminController::class,'change'])->name('admin#change');

    });
    //Products
    Route::prefix('products')->group(function(){
        Route::get('list',[ProductController::class,'list'])->name('product#list');
        Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
        Route::post('create',[ProductController::class,'create'])->name('product#create');
        Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
        Route::get('detail/{id}',[ProductController::class,'detail'])->name('product#detail');
        Route::get('update/{id}',[ProductController::class,'update'])->name('product#update');
        Route::post('update',[ProductController::class,'updateData'])->name('product#updateData');
        });

    Route::prefix('order')->group(function(){
        Route::get('list',[OrderController::class,'orderList'])->name('admin#orderList');
        Route::get('change/status',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
        Route::get('ajax/status/change',[OrderController::class,'statusChange'])->name('admin#statusChange');
        Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('admin#listInfo');

        });

    Route::prefix('user')->group(function(){
        Route::get('list',[UserController::class,'userList'])->name('admin#userList');
        Route::get('delete/{id}',[UserController::class,'userDelete'])->name('admin#userDelete');

        Route::get('ajax/role/change',[UserController::class,'userRoleChange'])->name('admin#userRoleChange');

        });

    Route::prefix('contact')->group(function(){
        Route::get('/',[ContactController::class,'contactPage'])->name('admin#contactPage');
        Route::get('delete/{id}',[ContactController::class,'contactDelete'])->name('admin#contactDelete');
        });
});


//user
//home
Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
   Route::get('home',[UserController::class,'home'])->name('user#home');
   Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');


   //Pizza details
    Route::prefix('pizza')->group(function(){
        Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('user#pizzaDetails');
    });

    //Cart
    Route::prefix('cart')->group(function(){
        Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
        Route::get('history',[UserController::class,'cartHistory'])->name('user#cartHistory');

    });

   //Password
   Route::prefix('password')->group(function(){
    Route::get('changePage',[UserController::class,'changePage'])->name('user#changePage');
    Route::post('updatePassword',[UserController::class,'updatePassword'])->name('user#updatePassword');
   });
    //Account
    Route::prefix('account')->group(function(){
      Route::get('accountPage',[UserController::class,'accountPage'])->name('user#accountPage');
      Route::get('editPage',[UserController::class,'editPage'])->name('user#editPage');
      Route::post('update/{id}',[UserController::class,'update'])->name('user#update');
    });
    //Ajax
    Route::prefix('ajax')->group(function(){
       Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
       Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
       Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
       Route::get('cart/clear',[AjaxController::class,'cartClear'])->name('ajax#cartClear');
       Route::get('remove/product',[AjaxController::class,'removeProduct'])->name('ajax#removeProduct');
       Route::get('view/count',[AjaxController::class,'viewCount'])->name('ajax#viewCount');


    });

    Route::prefix('contact')->group(function(){
        Route::get('/',[ContactController::class,'contact'])->name('user#contact');
        Route::post('contactMessage',[ContactController::class,'contactMessage'])->name('user#contactMessage');
});
});
});

// User
Route::get('webTesting',function(){
    $data = [
        'message'=>'this is testing'
    ];
    return response()->json($data, 200);
});
