<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'position';

    protected $primaryKey  = 'positionId';

    protected $fillable = [
            'position' ,
			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'positionId'=> 'integer',

    ];

}




