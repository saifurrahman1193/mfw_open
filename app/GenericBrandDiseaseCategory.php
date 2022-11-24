<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenericBrandDiseaseCategory extends Model
{
    protected $table = 'genericbranddiseasecategory';

    protected $primaryKey  = 'genericBrandDiseaseCategoryId';

    protected $fillable = [
            'genericBrandId' ,
            'diseaseCategoryId' ,
			'created_at',
            'updated_at'
    ];

    protected $casts = [
        'genericBrandDiseaseCategoryId'=> 'integer',
        'genericBrandId'=> 'integer',
        'diseaseCategoryId'=> 'integer',
    ];

}




