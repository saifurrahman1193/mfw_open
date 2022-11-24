<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierGenericPrices extends Model
{
    protected $table = 'sppliergenericprices';

    protected $primaryKey  = 'spplierGenericPriceId';

    protected $fillable = [
            'supplierId' ,
            'buyingPrice' ,
            'buyingDate' ,
            'note' ,
            'genericPackSizeId' ,
            'moq' ,
			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'spplierGenericPriceId'=> 'integer',
        'supplierId'=> 'integer',
        'genericPackSizeId'=> 'integer',
        'buyingPrice'=> 'double',
        'moq'=> 'double',
    ];

}

