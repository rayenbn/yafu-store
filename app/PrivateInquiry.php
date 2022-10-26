<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivateInquiry extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'private_inquiries';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'company_name',
        'email',
        'phone',
        'product_quantity',
        'question',
        'website',
        'social_media',
    ];
}
