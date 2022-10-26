<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyInquiry extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_inquiries';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'product',
        'product_quantity',
        'name',
        'company_name',
        'email',
        'phone',
        'website',
        'social_media',
        'message',
    ];
    
}
