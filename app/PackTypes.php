<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackTypes extends Model
{
    protected $table = 'packtypes';

    protected $primaryKey  = 'packTypeId';

    protected $fillable = [
            'packType' ,
            'packTypeCN' ,
            'packTypeRU' ,
			'created_at',
            'updated_at'
    ];
    

    protected $casts = [
        'packTypeId'=> 'integer',
    ];

}


