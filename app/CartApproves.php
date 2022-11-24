<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartApproves extends Model
{
    protected $table = 'cartapproves';

    protected $primaryKey  = 'cartApproveId';

    protected $fillable = [
            'paymentAccountDetailsId',
            'paymentMethodId',
            'paymentAccountDetailsTitle',
            'paymentAccountDetails',
            'paymentAccountDetailsCN',
            'paymentAccountDetailsRU',
            'paymentAccountDetailsAdditional',
            'paymentAccountDetailsAdditionalCN',
            'paymentAccountDetailsAdditionalRU',
            'cartId',
            'proformaCompanyId',
            'isProformaInvoiceVisible',

			'created_at',
            'updated_at',
    ];

    protected $casts = [
        'paymentAccountDetailsId'=> 'integer',
        'cartId'=> 'integer',
        'paymentMethodId'=> 'integer',
        'proformaCompanyId'=> 'integer',
        'isProformaInvoiceVisible'=> 'integer',
        
        
    ];

}




