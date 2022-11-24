<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BottomFooter extends Model
{
    protected $table = 'bottomfooter';

    protected $primaryKey  = 'bottomfooterId';

    protected $fillable = [
        

            'bottomfooter',
            'bottomfooterCN',
            'bottomfooterRU',

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'portion1Id'=> 'integer',
    ];

}

