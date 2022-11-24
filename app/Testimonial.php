<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonial';

    protected $primaryKey  = 'testimonialId';

    protected $fillable = [
            'testimonial' ,
            'testimonialRU' ,
            'testimonialCN' ,
            'userId',
            'manual_email',
            'manual_picpath',
            'manual_name',
            'visibility',
            'clientContact',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'testimonialId'=> 'integer',
        'userId'=> 'integer',
    ];

}


