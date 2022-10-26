<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aboutus extends Model
{

    protected $fillable = [
        'sec_one_title',
        'sec_one_text',
        'sec_one_img',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
