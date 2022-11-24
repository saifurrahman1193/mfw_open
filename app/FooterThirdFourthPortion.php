<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FooterThirdFourthPortion extends Model
{
    protected $table = 'footerthirdfourthportion';

    protected $primaryKey  = 'footerthirdfourthportionId';

    protected $fillable = [
            'thirdPortionCategoryId' ,
            'fourthPortionCategoryId' ,
			'created_at',
            'updated_at'
    ];

    protected $casts = [
        'footerthirdfourthportionId'=> 'integer',
        'thirdPortionCategoryId'=> 'integer',
        'fourthPortionCategoryId'=> 'integer',
    ];


}


