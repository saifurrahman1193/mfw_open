<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'pages';

    protected $primaryKey  = 'pageId';

    protected $fillable = [
        
            'pageTitle' ,
            'pageTitleCN',
            'pageTitleRU',

            'pageDesc',
            'pageDescCN',
            'pageDescRU',

            'isDeletable',

            'meta_keywords',
            'meta_keywordsCN',
            'meta_keywordsRU',

            'meta_description',
            'meta_descriptionCN',
            'meta_descriptionRU',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'pageId'=> 'integer',
    ];

}


