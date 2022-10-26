<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $fillable = [
        'fb',
        'twitter',
        'ig',
        'youtube',
        'address',
    ];
}
