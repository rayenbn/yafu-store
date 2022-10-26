<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'variants';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'price',
        'slug',
        'type_id',
        'created_at',
        'updated_at',
    ];

     /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    /**
     * Get the type that owns the variant.
     */
    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function getPriceAttribute($value)
    {
        return $value / 100;  
    }
    
}
