<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerGenericPrices extends Model
{
    protected $table = 'customergenericprices';

    protected $primaryKey  = 'customerGenericPriceId';

    protected $fillable = [
            'customerId' ,
            'price' ,
            'genericPackSizeId' ,
            'moq' ,
            'discount' ,

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'customerGenericPriceId'=> 'integer',
        'customerId'=> 'integer',
        'price'=> 'double',
        'moq'=> 'double',
        'discount'=> 'double',
    ];


}


