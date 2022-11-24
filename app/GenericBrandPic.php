<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenericBrandPic extends Model
{
    protected $table = 'genericbrandpic';

    protected $primaryKey  = 'genericBrandPicId';

    protected $fillable = [
            'genericBrandId' ,
            'picPath' ,

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'genericBrandPicId'=> 'integer',
    ];

}


