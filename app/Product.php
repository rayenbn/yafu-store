<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model 
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name', 
        'description',
        'price',
        'discount_price',
        'img',
        'video',
        'availability',
        'haslogo',
        'logoprice',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'keywords',
        'meta_desc',
    ];

    public function getLogopriceAttribute($value)
    {
        return $value / 100;  
    }

    public function path()
    {
        return url("/our-products/" . "{$this->id}-" . Str::slug($this->name));
    }

    public function categories()
    {
    	return $this->belongsToMany('App\Category', 'prod_cat')->where('status', 1)->orderBy('created_at','DESC')->withTimestamps();//->paginate(12);
    }

    public function colors()
    {
    	return $this->belongsToMany('App\Color', 'product_colors')->orderBy('created_at','DESC')->withTimestamps();//->paginate(12);
    }

    public function types()
    {
    	return $this->belongsToMany('App\Type', 'product_types')->orderBy('created_at','DESC')->withTimestamps();//->paginate(12);
    }

    // public function variants()
    // {
    // 	return $this->belongsToMany('App\Variant', 'product_variants')->orderBy('created_at','DESC')->withTimestamps();//->paginate(12);
    // }

    public function images()
    {
    	return $this->hasMany(ProductsImage::class);
    }

    // this is the recommended way for declaring event handlers
    public static function boot() {
        parent::boot();
        self::deleting(function($product) { // before delete() method call this
             $product->images()->each(function($image) {
                $image->delete(); // <-- direct deletion
             });
        });
    }
}
