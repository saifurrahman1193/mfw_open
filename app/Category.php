<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $primaryKey  = 'categoryId';

    protected $fillable = [
            'category' ,
            'categoryCN' ,
			'categoryRU' ,
			'created_at',
            'updated_at'
    ];

    protected $casts = [
        'categoryId'=> 'integer',
    ];

}


