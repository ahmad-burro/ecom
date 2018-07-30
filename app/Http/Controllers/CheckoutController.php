<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\address;
use App\orders;
use App\Product;

class CheckoutController extends Controller
{
    //
    public function index() {
        if(Auth::check()){
          $cartItems = Cart::content();
 
           return view('big_store.front.checkout', compact('cartItems'));
        
      }

    else {
        return redirect('cart');
    }


}

 public function formvalidate(Request $request) {
       // $this-validate($request, ['fullname' => 'required|min:5|max:35,'],
       //         ['fullname.required'=>'enter full name']);
    $this->validate($request, [
        'fullname' => 'required|min:5|max:35',
        'pincode' => 'required|numeric',
        'city' => 'required|min:5|max:25',
        'state' => 'required|min:5|max:35',
        'country' => 'required']);
 

       //$userid = admin::user()->id;
        $address = new address;
        $address->fullname = $request->fullname;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->pincode = $request->pincode;
        $address->country = $request->country;
        $address->payment_type = $request->pay;
        $address->user_id = $userid;
        $address->save();

        
         orders::createOrder();

        Cart::destroy();
        return redirect('thankyou');
   }




}
