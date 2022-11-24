<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenPackSizeGlobalMarketPrices extends Model
{
    protected $table = 'genpacksizeglobalmarketprices';

    protected $primaryKey  = 'globalMarketPriceId';

    protected $fillable = [
            'genericPackSizeId' ,
            'site' ,
			'price' ,
			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'globalMarketPriceId'=> 'integer',
        'genericPackSizeId'=> 'integer',
        'price'=> 'double',

    ];

}


