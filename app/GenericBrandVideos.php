<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenericBrandVideos extends Model
{
    protected $table = 'genericbrandvideos';

    protected $primaryKey  = 'genericbrandVideoId';

    protected $fillable = [
            'genericBrandId' ,
            'videoUrl',
            'thumbnailUrl',
			'created_at',
            'updated_at'
    ];

    protected $casts = [
        'genericbrandVideoId'=> 'integer',
        'genericBrandId'=> 'integer',
    ];

}

