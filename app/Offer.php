<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offer';

    protected $primaryKey  = 'offerId';

    protected $fillable = [
            'offer' ,
            'minAmount',
			'created_at',
            'updated_at'
    ];

    protected $casts = [
        'offerId'=> 'integer',
        'minAmount'=> 'double',
    ];

}
