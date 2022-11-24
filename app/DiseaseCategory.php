<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseaseCategory extends Model
{
    protected $table = 'diseasecategory';

    protected $primaryKey  = 'diseaseCategoryId';

    protected $fillable = [
            'diseaseCategory' ,
            'diseaseCategoryCN' ,
			'diseaseCategoryRU' ,
            'categoryId',
			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'diseaseCategoryId'=> 'integer',
        'categoryId'=> 'integer',
    ];

}


