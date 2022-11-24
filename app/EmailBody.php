<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailBody extends Model
{
    protected $table = 'emailbody';

    protected $primaryKey  = 'emailBodyId';

    protected $fillable = [
            'emailBodyTitle' ,
            'emailBody' ,
			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'emailBodyId'=> 'integer',
    ];

}


