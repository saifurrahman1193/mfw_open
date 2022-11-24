<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FooterPortion2Pages extends Model
{
    protected $table = 'footerportion2pages';

    protected $primaryKey  = 'footerportion2pagesId';

    protected $fillable = [
        
            'pageId',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'footerportion2pagesId'=> 'integer',
        'pageId'=> 'integer',
    ];

}



