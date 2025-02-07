<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request){
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if(Auth::check())
        {
            $prod_check = Product::where('id',$product_id)->first();
            if($prod_check)
            {
                if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists())
            {
                return response()->json(['status'=>$prod_check->name." Already Added To Cart"] );

            }
            else{
                $cart_Item = new Cart();
                $cart_Item->prod_id = $product_id;
                $cart_Item->user_id = Auth::id();
                $cart_Item->prod_qty = $product_qty;
                $cart_Item->save();
                return response()->json(['status'=>$prod_check->name."  Added To Cart"] );

            }
        }
        }
        else
        {
            return response()->json(['status'=>"Login to continue"]);
        }
    }

    public function viewcart()
    {
        $cartitems = Cart::where('user_id',Auth::id())->get();
        return view('frontend.cart',compact('cartitems'));
    }

    
}
