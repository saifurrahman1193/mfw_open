<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';

    protected $primaryKey  = 'bannerId';

    protected $fillable = [
            'title' ,
            'titleCN',
            'titleRU',

            'desc',
            'descCN',
            'descRU',
            
            'picPath',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'bannerId'=> 'integer',
    ];

}

