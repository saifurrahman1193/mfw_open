<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FooterPortion3Categories extends Model
{
    protected $table = 'footerportion3categories';

    protected $primaryKey  = 'footerportion3categoryId';

    protected $fillable = [
        
            'categoryId',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'footerportion3categoryId'=> 'integer',
        'categoryId'=> 'integer',
    ];

}



