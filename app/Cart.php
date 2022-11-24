<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';

    protected $primaryKey  = 'cartId';

    protected $fillable = [
            'takingFor' ,
            'takingForLocalLang' ,
            'email' ,
            'phone' ,
            'phonenumber2',
            'shippingAddress' ,
            'postalCode' ,
            'customerId' ,
            'shippingAmount' ,
            'cartStatus' ,
            'totalAmount' ,
            'discount' ,
            'tax' ,
            'totalQty' ,
            'totalProducts' ,
            'subTotalAmount' ,
            'deliveryMethodId' ,
            'deliveryComment',
            'stateProvinceRegionDistrict' ,

            'countryId',
            'streethouse',
            'streethouseLocalLang',
            'phoneCode',

            'usdToCurrencyRate',
            'currency',
            'cartWeightGM',

            'deliveryPriceInitial',
            'deliveryPriceIncrement',

            'city',
            'cityLocalLang',

            'paymentComment',
            'paymentCountryId',
            'paymentMethodId',
            'transactionFee',
            'transactionFeeAmount',

            'offer',
            'isManualCart',

            'patientName',
            'takingForRelationship',
            'socialMedia',
            'website',


			'created_at',
            'updated_at',
    ];

    protected $casts = [
        'cartId'=> 'integer',
        'paymentMethodId'=> 'integer',
        'postalCode'=> 'integer',
        'deliveryMethodId'=> 'integer',
        'customerId'=> 'integer',
        'shippingAmount'=> 'double',
        'totalAmount'=> 'double',
        'discount'=> 'double',
        'tax'=> 'double',
        'totalQty'=> 'double',
        'subTotalAmount'=> 'double',
        'totalProducts'=> 'integer',
        'countryId'=> 'integer',
        'usdToCurrencyRate'=> 'double',
        'cartWeightGM'=> 'double',
        'deliveryPriceInitial'=> 'double',
        'deliveryPriceIncrement'=> 'double',
        'transactionFee'=> 'double',
        'transactionFeeAmount'=> 'double',
        'isManualCart'=> 'integer',
        
        
    ];

}




