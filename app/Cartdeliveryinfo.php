<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartdeliveryinfo extends Model
{
    protected $table = 'cartdeliveryinfo';

    protected $primaryKey  = 'cartDeliveryInfoId';

    protected $fillable = [
            'message' ,
            'messageCN' ,
            'messageRU' ,
            'picPath' ,
            'cartId' ,
            'userId' ,
            'isCustomer' ,
            'batch' ,
            

			'created_at',
            'updated_at'
    ];

    protected $casts = [
        'cartDeliveryInfoId'=> 'integer',
    ];

}
