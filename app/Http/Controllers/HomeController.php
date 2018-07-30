<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

use Illuminate\Support\Facades\DB;

use App\Category;
use App\about;

 
use App\altimages;

 
use Storage;



use Image;

use App\products_properties;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $products=Product::all();
          $categories=Category::all();
        return view('big_store.front.home');
    }

public function shop()
    {        $products=Product::all();
          $categories=Category::all();

        return view('big_store.front.shop',compact(['categories','products']));
    }


    public function product_details($id){
 $products=Product::findOrFail($id);

return view('big_store.front.product_details',compact('products'));
echo $id;

    }


    public function contact()
    {
        return view('front.contact');
    }




}
