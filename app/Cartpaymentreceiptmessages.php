<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartpaymentreceiptmessages extends Model
{
    protected $table = 'cartpaymentreceiptmessages';

    protected $primaryKey  = 'cartPaymentReceiptMessageId';

    protected $fillable = [
            'reason' ,
            'reasonCN' ,
            'reasonRU' ,
            'picPath' ,
            'cartId' ,
            'userId' ,
            'isCustomer' ,
            'batch' ,

			'created_at',
            'updated_at'
    ];

    protected $casts = [
        'cartPaymentReceiptMessageId'=> 'integer',
        'cartId'=> 'integer',
        'userId'=> 'integer',
        'isCustomer'=> 'integer',
        'batch'=> 'integer',
    ];

}
