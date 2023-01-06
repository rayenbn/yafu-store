<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'category_name',
        'category_image',
        'slug',
        'parent_category_id',
        'created_at',
        'updated_at',
        'position',
        'has_parent',
        'show_in_home_page',
        'subtitle',
        'desc',
        'order',
        'status',
    ];
    
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    

    public function products()
    {
    	return $this->belongsToMany('App\Product','prod_cat')->where('status', 1)->orderBy('created_at','ASC')->paginate(12);
    }

    public function randomProducts()
    {
    	return $this->belongsToMany('App\Product','prod_cat')->where('status', 1)->inRandomOrder()->limit(8)->get();;
    }

    // One level child
    public function child() {
        return $this->hasMany('App\Category', 'parent_category_id');
    }

    // Recursive children
    public function children() {
        return $this->hasMany('App\Category', 'parent_category_id')->with('children');
    }

    public function path()
    {
        return url("/products/" . "{$this->id}-" . Str::slug($this->category_name));
    }

    // One level parent
    public function parent() {
        return $this->belongsTo('App\Category', 'parent_category_id');
    }

    // Recursive parents
    public function parents() {
        return $this->belongsTo('App\Category', 'parent_category_id')->with('parent');
    }
    
    // public function getRouteKeyName()
    // {
    // 	return 'slug';
    // }
}
