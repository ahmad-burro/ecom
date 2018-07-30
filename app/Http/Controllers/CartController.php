<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Product;

use Illuminate\Http\Request;

class CartController extends Controller
{
        public function index() {    
            $cartItems = Cart::content();
           $products=Product::all();

        return view('big_store.cart.index', compact('cartItems','products'));
    }

    public function addItem($id) {          
     echo $id;

        $product = product::find($id);
                 Cart::add($id, $product->pro_name, 1, $product->pro_price, ['img' => $product->image]);

                 return back();
     

}
 public function destroy($id){
        Cart::remove($id);
         // echo $id;
       return back();
    }


    /*
         Cart::add($id, $product->pro_name, 1, $product->pro_price, ['img' => $product->image]);
          return back();*/


   

   public function  update(Request $request, $id){
    
       Cart::update($id, $request->qty);
      return back(); 
    }    }