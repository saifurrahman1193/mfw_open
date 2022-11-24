<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SEODefault extends Model
{
    protected $table = 'seodefault';

    protected $primaryKey  = 'seodefaultId';

    protected $fillable = [
            
            'pageTitle' ,
            'pageTitleCN',
            'pageTitleRU',

            'meta_keywords',
            'meta_keywordsCN',
            'meta_keywordsRU',

            'meta_description',
            'meta_descriptionCN',
            'meta_descriptionRU',

            
			'created_at',
            'updated_at'
    ];

    protected $casts = [
        'seodefaultId'=> 'integer',
    ];

}


