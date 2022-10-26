<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model 
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'colors';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'color_code',
        'color_name',
        'price',
        'slug',
    ];

     /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    
}
