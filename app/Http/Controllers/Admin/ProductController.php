<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index',compact('products'));
    }
    public function add()
    {
        $category = Category::all();
        return view('admin.product.add',compact('category'));
    }
    public function insert(Request $request)
    {
        $product = new Product();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/product/',$filename);
            $product->image = $filename;
        }
        $product->cate_id = $request->input('cate_id');
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->small_description = $request->input('small_description');
        $product->description = $request->input('description');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->qty = $request->input('quantity');
        $product->tax = $request->input('tax');
        $product->status = $request->input('status') == true ?'1':'0';
        $product->trending = $request->input('trending') == true ?'1':'0';
        $product->meta_title = $request->input('meta_title');
        $product->meta_description = $request->input('meta_keywords');
        $product->meta_keyword = $request->input('meta_description');
        $product->save();
        return redirect('/dashboard')->with('status',"Product Added Succcessfully"); 
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.product.edit',compact('product','category'));
    }

    public function update(Request $request,$id)
    {
        $product = Product::find($id);
        if($request->hasFile('image'))
        {
            $path = 'assets/uploads/product/'.$product->image;
            if(File::exists($path))
            {
                FIle::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category/',$filename);
            $product->image = $filename;
        }
        $product->cate_id = $request->input('cate_id');
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->small_description = $request->input('small_description');
        $product->description = $request->input('description');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->qty = $request->input('quantity');
        $product->tax = $request->input('tax');
        $product->status = $request->input('status') == true ?'1':'0';
        $product->trending = $request->input('trending') == true ?'1':'0';
        $product->meta_title = $request->input('meta_title');
        $product->meta_description = $request->input('meta_keywords');
        $product->meta_keyword = $request->input('meta_description');
        $product->update();
        return redirect('/dashboard')->with('status',"Product Updated Succcessfully"); 
    }

    public function delete($id){
        $product = Product::find($id);
        if($product->image)
        {
            $path = 'assets/uploads/product/'.$product->image;
            if(File::exists($path))
            {
                File::delete($path); 
            }
        }
        $product->delete();
        return redirect('/dashboard')->with('status',"Product Deleted Succcessfully"); 
    }
}
