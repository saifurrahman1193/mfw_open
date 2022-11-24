<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';

    protected $primaryKey  = 'blogId';

    protected $fillable = [
            'title' ,
            'titleCN' ,
            'titleRU' ,
            'post' ,
            'postCN' ,
            'postRU' ,
            'photoPath' ,
            'bloggerId' ,

			'created_at',
			'updated_at',
    ];

    protected $casts = [
        'blogId'=> 'integer',
        'bloggerId'=> 'integer',
    ];

}


