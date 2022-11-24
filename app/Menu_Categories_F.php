<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu_Categories_F extends Model
{
    protected $table = 'menu_categories_f';

    protected $primaryKey  = 'menuCategoriesFId';

    protected $fillable = [
            'categoryId' ,

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'menuCategoriesFId'=> 'integer',
    ];

}


