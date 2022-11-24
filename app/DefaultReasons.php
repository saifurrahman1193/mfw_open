<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultReasons extends Model
{
    protected $table = 'defaultreasons';

    protected $primaryKey  = 'defaultReasonId';

    protected $fillable = [
            'defaultReason' ,
            'defaultReasonCN' ,
			'defaultReasonRU' ,
			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'defaultReasonId'=> 'integer',
    ];

}

