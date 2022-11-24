<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FooterPortion4Socials extends Model
{
    protected $table = 'footerportion4socials';

    protected $primaryKey  = 'footerportion4socialsId';

    protected $fillable = [
        
            'footerportion4socialsId',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'footerportion4socialsId'=> 'integer',
        'socialMediaId'=> 'integer',
    ];

}

