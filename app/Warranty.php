<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warranty extends Model 
{
    protected $fillable = [
        'title',
        'content'
    ];
}
