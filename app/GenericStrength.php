<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenericStrength extends Model
{
    protected $table = 'genericstrength';

    protected $primaryKey  = 'genericStrengthId';

    protected $fillable = [
            'genericStrength' ,
            'genericStrengthCN' ,
            'genericStrengthRU' ,
			'created_at',
            'updated_at'
    ];

    protected $casts = [
        'genericStrengthId'=> 'integer',
    ];

}



