<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $table = 'weight';

    protected $primaryKey  = 'weightId';

    protected $fillable = [
            'weightGM' ,
            'packTypeId',


			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'weightId'=> 'integer',
        'weightGM'=> 'double',
        'packTypeId'=> 'integer',
    ];

}
