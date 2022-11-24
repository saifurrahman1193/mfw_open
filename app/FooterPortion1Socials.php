<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FooterPortion1Socials extends Model
{
    protected $table = 'footerportion1socials';

    protected $primaryKey  = 'footerportion1socialsId';

    protected $fillable = [
        
            'footerportion1socialsId',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'footerportion1socialsId'=> 'integer',
        'socialMediaId'=> 'integer',
    ];

}

