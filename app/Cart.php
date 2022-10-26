<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'prod_id',
        'prod_img',
        'prod_name',
        'prod_desc',
        'price',
        'total',
        'qty',
        'created_by',
        'submited',
        'invoice_number',
        'logofile',
    ];

    public function getPriceAttribute($value)
    {
        return $value / 100;  
    }
    public function getTotalAttribute($value)
    {
        return $value / 100;  
    }
}
