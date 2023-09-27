<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //Public Function
    //direct list page
    function list() {
        $categories=Category::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })
        ->orderBy('created_at','asc')
        ->paginate(5);

        return view('admin.category.list',compact('categories'));
    }
    //direct create page
    function createPage() {
        return view('admin.category.create');
    }
    //create category
    function create(Request $req){
        $this->categoryValidationcheck($req);
        $data=$this->reqCategorydate($req);
        Category::create($data);
        return redirect()->route('category#list')->with(['createSuccess'=>'Create Success']);
    }
    //delete category
    function delete($id){
        Category::where('id',$id)->delete();
        return redirect()->route('category#list')->with(['deleteSuccess'=>'Delete Success']);
    }

    //edit Category
    function edit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    //update Category
    function update(Request $req){

        $this->categoryValidationcheck($req);
        $data=$this->reqCategorydate($req);
        $id = $req->categoryId;
        Category::where('id',$id)->update($data);
        return redirect()->route('category#list')->with(['updateSuccess'=>'Update Success']);
    }
    // Private Function
    //create validation
    private function categoryValidationcheck($req){
        Validator::make($req->all(),[
        'categoryName'=>'required|unique:categories,name,'.$req->categoryId,
        ])->validate();
    }
    //req date
    private function reqCategorydate($req){
        return[
            'name'=> $req->categoryName
        ];
    }
}
