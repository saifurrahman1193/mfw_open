<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';

    protected $primaryKey  = 'supplierId';

    protected $fillable = [
            'supplier' ,
            'phone' ,
            'email' ,
            'address' ,
            'countryId' ,
            'genericCompanyId' ,
            'positionId' ,
            'knownBy' ,

            'comment' ,
            'thirdPartyCompany' ,

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'supplierId'=> 'integer',
        'countryId'=> 'integer',
        'genericCompanyId'=> 'integer',
        'positionId'=> 'integer',
    ];

}

