<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class GenericPackSizes extends Model
{
    protected $table = 'genericpacksizes';
    protected $primaryKey  = 'genericPackSizeId';

    protected $fillable = [
            'genericPackSize' ,
            'packTypeId' ,
            'genericBrandId' ,
            'genericStrengthId' ,
            'ptSellingPrice' ,

            'ptMOQ' ,
            'dealerSellingPrice' ,
            'dealerMOQ' ,
            'compPtSellingPrice' ,
            'compPtSellingPriceOld' ,
            'compLocalSellingPrice' ,
			'vipSellingPrice' ,
            'availabilityTypeId',
            'weightGM',
            'dosageFormId',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'genericPackSizeId'=> 'integer',
        'genericPackSize'=> 'double',
        'packTypeId'=> 'integer',
        'genericBrandId'=> 'integer',
        'genericStrengthId'=> 'integer',
        'availabilityTypeId'=> 'integer',
        'dosageFormId'=> 'integer',
        
        

        'ptSellingPrice'=> 'double',
        'ptMOQ'=> 'double',
        'dealerMOQ'=> 'double',
        'compPtSellingPrice'=> 'double',
        'compPtSellingPriceOld'=> 'double',
        'compLocalSellingPrice'=> 'double',
        
        'weightGM'=> 'double',

    ];


}



