<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainSliders extends Model
{
    protected $table = 'mainsliders';

    protected $primaryKey  = 'mainsliderId';

    protected $fillable = [
            'photoPath' ,
            'text1' ,
            'text1RU' ,
            'text1CN' ,
            'text2' ,
            'text2RU' ,
            'text2CN' ,

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'mainsliderId'=> 'integer',
    ];




}


