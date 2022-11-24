<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider_New_Selling_Products extends Model
{
    protected $table = 'slider_new_selling_products';

    protected $primaryKey  = 'slider_new_selling_product_id';

    protected $fillable = [
            'genericBrandId' ,

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'slider_new_selling_product_id'=> 'integer',
    ];

}


