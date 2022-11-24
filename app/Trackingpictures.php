<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trackingpictures extends Model
{
    protected $table = 'trackingpictures';

    protected $primaryKey  = 'trackingPicId';

    protected $fillable = [
            'picPath' ,
            'trackingId' ,
			'created_at',
            'updated_at'
    ];

    protected $casts = [
        'trackingPicId'=> 'integer',
        'trackingId'=> 'integer',
    ];

}

