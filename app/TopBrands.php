<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopBrands extends Model
{
    protected $table = 'topbrands';

    protected $primaryKey  = 'topBrandId';

    protected $fillable = [
            'genericCompanyId' ,
            'picPath',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'genericCompanyId'=> 'integer',
    ];

}


