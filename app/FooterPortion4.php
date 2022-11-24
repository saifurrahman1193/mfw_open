<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FooterPortion4 extends Model
{
    protected $table = 'footerportion4';

    protected $primaryKey  = 'portion4Id';

    protected $fillable = [
        
            'portion4Title' ,
            'portion4TitleCN',
            'portion4TitleRU',

            'portion4Desc',
            'portion4DescCN',
            'portion4DescRU',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'portion4Id'=> 'integer',
    ];

}

