<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    protected $table = 'deliverymethod';

    protected $primaryKey  = 'deliveryMethodId';

    protected $fillable = [
            'deliveryMethod' ,
            'deliveryMethodCN' ,
            'deliveryMethodRU' ,
            'isCommentApplicable',
            'isCommentRequired',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'deliveryMethodId'=> 'integer',
        'isCommentApplicable'=> 'integer',
        'isCommentRequired'=> 'integer',
    ];

    protected $attributes = [
    	'isCommentApplicable' => 0,
    	'isCommentRequired' => 0,
    ];

}


