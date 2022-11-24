<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentReceiptDefaultMessages extends Model
{
    protected $table = 'paymentreceiptdefaultmessages';

    protected $primaryKey  = 'defaultReasonId';

    protected $fillable = [
            'defaultReason' ,
            'defaultReasonCN' ,
			'defaultReasonRU' ,
			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'defaultReasonId'=> 'integer',
    ];

}

