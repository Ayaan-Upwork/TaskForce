<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
// use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        return view('admin.category.index',compact('category'));
    }

    public function add(){
        return view('admin.category.add');
    }
    public function insert(Request $request){
        $category = new Category();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category/',$filename);
            $category->image = $filename;
        }
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == true ?'1':'0';
        $category->popular = $request->input('popular') == true ?'1':'0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_descrip = $request->input('meta_keywords');
        $category->meta_keywords = $request->input('meta_description');
        $category->save();
        return redirect('/dashboard')->with('status',"Category Added Succcessfully"); 

    }
    public function edit($id){
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }
    PUblic function update(Request $request,$id){
        $category = Category::find($id) ;
        if($request->hasFile('image'))
        {
            $path = 'assets/uploads/category/'.$category->image;
            if(File::exists($path))
            {
                FIle::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category/',$filename);
            $category->image = $filename;
        }
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == true ?'1':'0';
        $category->popular = $request->input('popular') == true ?'1':'0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_descrip = $request->input('meta_keywords');
        $category->meta_keywords = $request->input('meta_description');
        $category->update();
        return redirect('/dashboard')->with('status',"Category UPdated Succcessfully"); 
    }
    
    public function delete($id){
        $category = Category::find($id);
        if($category->image)
        {
            $path = 'assets/uploads/category/'.$category->image;
            if(File::exists($path))
            {
                File::delete($path); 
            }
        }
        $category->delete();
        return redirect('categories')->with('status',"Category Deleted Succcessfully"); 
    }

}
