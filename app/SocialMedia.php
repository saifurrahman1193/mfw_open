<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $table = 'socialmedia';

    protected $primaryKey  = 'socialMediaId';

    protected $fillable = [
            'socialMedia' ,
            'iconclass' ,
            'iconsrc' ,
            'link' ,
            'info' ,
            'picPath' ,
			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'socialMediaId'=> 'integer',
    ];

}

