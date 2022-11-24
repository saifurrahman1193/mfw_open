<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenericCompany extends Model
{
    protected $table = 'genericcompany';

    protected $primaryKey  = 'genericCompanyId';

    protected $fillable = [
            'genericCompany' ,
            'genericCompanyCN' ,
			'genericCompanyRU' ,
			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'genericCompanyId'=> 'integer',
    ];

}
