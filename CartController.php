<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;


class CartController extends Controller
{
    //
    public function prodcart(Request $request){
           $product_id = $request->input('product_id');
           $product_qty = $request->input('product-qty');

           if(Auth::check()){
              $prod_check = Product::where('id', $product_id)->first();
              if($prod_check){
                  if(Cart::where('prod_id',$product_id)->where('user_id', Auth::id())->exists()){
                    return response()->json(['status' => $prod_check->name. " already added to cart successfully"]);

                  }
                  else{
                    $cartItem = new Cart();
                    $cartItem -> prod_id = $product_id;
                    $cartItem -> user_id = Auth::id();
                    $cartItem -> prod_qty = $product_qty;
                    $cartItem -> save();
                    return response()->json(['status' => $prod_check->name. " added to cart successfully"]);
  
                  }
                 
              }
           }
           else{
               return response()->json(['status'=>"Login to access cart"]);
           }
    }
}
