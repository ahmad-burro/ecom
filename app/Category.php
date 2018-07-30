<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name'];
 
     
//     public function Product()
// {

//     return $this->belongsToMany('App\product', 'products_categories', 
//       'products_id','categories_id');


   
  public function products()
    {
//
        return $this->hasMany(products::class);
    }
}
