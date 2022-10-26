<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

       /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'types';

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'password',
        'created_at',
        'updated_at',
    ];

    public function variants()
    {
        return $this->hasMany('App\Variant');
    }

    public function products()
    {
    	return $this->belongsToMany('App\Product','product_types')->orderBy('created_at','ASC')->paginate(12);
    }


    // this is the recommended way for declaring event handlers
    public static function boot() {
        parent::boot();
        self::deleting(function($type) { // before delete() method call this
             $type->variants()->each(function($variant) {
                $variant->delete(); // <-- direct deletion
             });
           
        });
    }
}
