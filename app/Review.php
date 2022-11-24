<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';

    protected $primaryKey  = 'reviewId';

    protected $fillable = [
            'comment' ,
            'genericBrandId' ,
            'reviewerId' ,
            'manualName' ,
            'manualEmail' ,
            'manualCountryCode',
            'manualPhone',
            'rating' ,
			'isApproved' ,
			'created_at',
            'updated_at'
    ];

    protected $casts = [
        'reviewId'=> 'integer',
    ];

}


