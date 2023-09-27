<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    //direct products list
    function list(){
        $pizzas = Product::select('products.*','categories.name as category_name')
        ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','asc')
        ->paginate(4);
        $pizzas->appends(request()->all());
        return view('admin.products.pizzaList',compact('pizzas'));
    }
    //direct create page
    function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.products.create',compact('categories'));
    }
    //Product Create
    function create(Request $request){
        $this->productValidationCheck($request,"create");
        $data = $this->getPizzaData($request);

        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#list')->with(['createSuccess'=>'Product successfully created']);
    }
     //delete Product
     function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=>'Delete Success']);
    }
    //pizza detail
    function detail($id){

        $pizza = Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.products.detail',compact('pizza'));
    }
    //pizza update
    function update($id){
        $pizza = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.products.update',compact('pizza','category'));
    }
    //pizza update save
    function updateData(Request $request){
        $this->productValidationCheck($request,"update");
        $data = $this-> getPizzaData($request);
       if($request->hasFile('pizzaImage')){
        $oldImageName = Product::where('id',$request->pizzaId)->first();
        $oldImageName = $oldImageName->image;
        Storage::delete('public/'.$oldImageName);
        $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;
       }
       Product::where('id',$request->pizzaId)->update($data);
       return redirect()->route('product#list')->with(['updateSuccess'=>'Update Success']);
    }



    //Product Validation
    private function productValidationCheck($request,$action){
        $validationRules = [
            'pizzaName'=>'required|unique:products,name,' .$request->pizzaId ,
            'pizzaCategory'=>'required',
            'pizzaDescription'=>'required',
            'pizzaPrice'=>'required',
            'pizzaWaitingTime'=>'required',

        ];
        $validationRules['pizzaImage'] = $action == "create" ? 'required|mimes:png,jpg,jpeg,avif' : 'mimes:png,jpg,jpeg,avif';
        Validator::make($request->all(),$validationRules)->validate();
    }
    //Pizza create data req
    private function getPizzaData($request){
        return [
            'name'=> $request->pizzaName,
            'category_id'=> $request->pizzaCategory,
            'description'=> $request->pizzaDescription,
            'price'=> $request->pizzaPrice,
            'waiting_time'=>$request->pizzaWaitingTime,
        ];
    }
}
