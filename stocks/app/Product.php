<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	
	  protected $fillable = [
	  	    'category_id',
		    'product_name',
		    'price',
		    'picture_path',
		   
		  ];
    protected  $primaryKey = 'id';
	protected $table = 'products';
}
