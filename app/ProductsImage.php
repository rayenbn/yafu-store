<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsImage extends Model
{
    protected $fillable = [
        'productImages', 'product_id',
      ];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
