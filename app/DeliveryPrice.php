<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryPrice extends Model
{
    protected $table = 'deliveryprice';

    protected $primaryKey  = 'deliveryPriceId';

    protected $fillable = [
            'deliveryPriceInitial' ,
            'deliveryPriceIncrement' ,
            'countryId' ,
            'deliveryMethodId' ,

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'deliveryPriceId'=> 'integer',
        'deliveryPriceInitial'=> 'double',
        'deliveryPriceIncrement'=> 'double',
        'countryId'=> 'integer',
        'deliveryMethodId'=> 'integer',
    ];

}

