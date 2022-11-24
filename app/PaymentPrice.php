<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentPrice extends Model
{
    protected $table = 'paymentprice';

    protected $primaryKey  = 'paymentPriceId';

    protected $fillable = [
            'countryId' ,
            'paymentMethodId' ,

            'transactionFee' ,

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'paymentPriceId'=> 'integer',
        'countryId'=> 'integer',
        'paymentMethodId'=> 'integer',
        'transactionFee'=> 'double',
    ];

}

