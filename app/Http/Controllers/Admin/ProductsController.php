<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
 
use App\Category;
use App\about;
use App\Product;
use App\altimages;
 use Storage;
use App\products_properties;

 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
 
class ProductsController extends Controller
{



   //    public function index()
   // {
   //  return view('admin.index');
   // }

     public function index()
    {
        $products=Product::all();
        return view('admin.product.index',compact('products'));
    }

   // public function cats() {
   //   return view('admin.index');
   // }

   // public function index() {
   
   //    $cat_data = DB::table('pro_cat')->get();
   //    // $Products = DB::table('products')->get();
   //    // $cat_data=Pro_cat::all();
   //      // return view('admin.home');
   //      return view('admin.home', compact('cat_data'));
   //  }

   public function create()
    {
   $categories=Category::pluck('name','id');
        return view('admin.product.create', compact('categories'));
    }

    //  public function home()
    // {
    //   $cat_data = DB::table('pro_cat')->get();
    //     // return view('admin.home');
    //     return view('admin.home', compact('cat_data'));
    // }

    // public function addpro_form(){
    //   $cat_data = DB::table('pro_cat')->get();

    //   return view('admin.home', compact('cat_data'));
    // }


    //  public function cats()
    // {
    //     return view('admin.home');
    // }

    // public function addpro_form(){
    //   $cat_data = DB::table('pro_cat')->get();

    //   return view('admin.home', compact('cat_data'));
    // }



   public function store(Request $request) 

    {

        $formInput=$request->except('image');
//        validation
      
        $this->validate($request,[
            'pro_name'=>'required',
            'pro_code'=>'required',
            'pro_price'=>'required',
            'pro_info'=>'required',
            'spl_price'=>'required',
            'image'=>'image|mimes:png,jpg,jpeg|max:10000'
        ]);
        
      
        $image=$request->image;
        if($image){
            $imageName=$image->getClientOriginalName();
            $image->move('images',$imageName);
            $formInput['image']=$imageName;
        }
     
        $categories=Category::all();
        Product::create($formInput);
        // return redirect()->route('admin.index');
session()->flash('success', trans('admin.record_added'));
    return redirect(aurl('product'));
  }


public function show($id)
    {
        $product = Product::findOrFail($id);
    
        // $blog = Blog::whereSlug($slug)->first();
        //return view('product.show', compact('products'));
        // var_dump($product);
         dd( $product);

    }



    public function edit($id) {
        $product = Product::find($id);
         return view('admin.product.edit', compact('Product', 'title'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $id) {
        $data = $this->validate(request(),
            [
               'pro_name'=>'required',
            'pro_code'=>'required',
            'pro_price'=>'required',
            'pro_info'=>'required',
            'spl_price'=>'required',
            'image'=>'image|mimes:png,jpg,jpeg|max:10000'
                
                      ]);
 
        Product::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
                 dd( $data);

        return redirect(aurl('product'));

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Admin::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('admin'));
    }
    public function multi_delete() {
        if (is_array(request('item'))) {
            Admin::destroy(request('item'));
        } else {
            Admin::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('admin'));
    }
/*
    
public function get_allproduct( ){

  
$all_product = Category::where('id',1)->first()->Product()->get();


 $products = Product::with('Category')->get();

foreach($products as $product)
{
    foreach($product->categories as $category)
    {
        echo $category->name;
    }
}
}*/

}