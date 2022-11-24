<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genericforallproduct extends Model
{
    protected $table = 'genericforallproduct';

    protected $primaryKey  = 'genericforallproductId';

    protected $fillable = [
            'genericId',
            'metaTitle',
            'metaTitleCN',
            'metaTitleRU',
            'metaDesc',
            'metaDescCN',
            'metaDescRU',
            'metaKeywords',
            'metaKeywordsCN',
            'metaKeywordsRU',

            'description',
            'descriptionCN',
            'descriptionRU',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'genericforallproductId'=> 'integer',
        'genericId'=> 'integer',
    ];

}

