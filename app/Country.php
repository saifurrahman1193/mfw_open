<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country';

    protected $primaryKey  = 'countryId';

    protected $fillable = [
            'country' ,
            'currency' ,
            'usdToCurrencyRate' ,
            'iso',
            'nicename',
            'iso3',
            'numCode',
            'phoneCode',
            'hexcode',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'countryId'=> 'integer',
        'usdToCurrencyRate'=> 'double',
    ];

}

