<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentSummary extends Model
{
    protected $table = 'paymentsummary';

    protected $primaryKey  = 'paymentSummaryId';

    protected $fillable = [
            'paymentMethodId' ,
            'paymentSummary',
            'paymentSummaryCN' ,
            'paymentSummaryRU' ,

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'paymentSummaryId'=> 'integer',
        'paymentMethodId'=> 'integer',
    ];

}


