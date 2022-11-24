<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentAccountDetails extends Model
{
    protected $table = 'paymentaccountdetails';

    protected $primaryKey  = 'paymentAccountDetailsId';

    protected $fillable = [
            'paymentAccountDetailsTitle' ,
            'paymentAccountDetails',
            'paymentAccountDetailsCN' ,
            'paymentAccountDetailsRU' ,

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'paymentAccountDetailsId'=> 'integer',
        'paymentMethodId'=> 'integer',
    ];

}

