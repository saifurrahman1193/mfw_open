<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'paymentmethod';

    protected $primaryKey  = 'paymentMethodId';

    protected $fillable = [
            'paymentMethod' ,
            'paymentMethodCN' ,
            'paymentMethodRU' ,
            'isCommentApplicable',
            'isCommentRequired',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'paymentMethodId'=> 'integer',
        'isCommentApplicable'=> 'integer',
        'isCommentRequired'=> 'integer',
    ];

    protected $attributes = [
    	'isCommentApplicable' => 0,
    	'isCommentRequired' => 0,
    ];

}


