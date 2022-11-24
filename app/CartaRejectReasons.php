<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartaRejectReasons extends Model
{
    protected $table = 'cartarejectreasons';

    protected $primaryKey  = 'cartRejectReasonId';

    protected $fillable = [
            'reason' ,
            'reasonCN' ,
            'reasonRU' ,

 

            'cartId' ,


			'created_at',
            'updated_at',
    ];

    protected $casts = [
        'cartRejectReasonId'=> 'integer',
        'cartId'=> 'integer',
        
        
    ];

}

