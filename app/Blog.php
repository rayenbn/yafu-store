<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title',
        'image',
        'text',
        'created_by',
        'created_at',
        'updated_at',
    ];

    public function path()
    {
        return url("/blogs/{$this->id}-" . Str::slug($this->title));
    }
}
