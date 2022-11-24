<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compare extends Model
{
    protected $table = 'compare';

    protected $primaryKey  = 'compareId';

    protected $fillable = [
            'genericBrandId' ,
            'comparerId',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'compareId'=> 'integer',
        'genericBrandId'=> 'integer',
        'comparerId'=> 'integer',
    ];

}


