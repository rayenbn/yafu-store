<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sliders';
     /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'picture',
        'link',
        'title',
        'subtitle',
    ];
    protected $guarded = [];


}
