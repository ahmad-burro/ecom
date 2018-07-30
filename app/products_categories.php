<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products_categories extends Model
{

	 protected $table = 'products_categories';
    protected $primaryKey = 'id';

protected $fillable = [
        'products_id','categories_id',
    ];

}
