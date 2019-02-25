<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_category extends Model
{
    protected $fillable = [
    'category_name'
  ];

  protected  $primaryKey = 'id';
  protected $table = 'product_categories';
}
