<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FooterPortion1 extends Model
{
    protected $table = 'footerportion1';

    protected $primaryKey  = 'portion1Id';

    protected $fillable = [
        
            'portion1Title' ,
            'portion1TitleCN',
            'portion1TitleRU',

            'portion1Desc',
            'portion1DescCN',
            'portion1DescRU',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'portion1Id'=> 'integer',
    ];

}

