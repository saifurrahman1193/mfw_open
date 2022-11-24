<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlist';

    protected $primaryKey  = 'wishlistId';

    protected $fillable = [
            'genericBrandId' ,
            'wisherId',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'wishlistId'=> 'integer',
        'genericBrandId'=> 'integer',
        'wisherId'=> 'integer',
    ];

}


