<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProformaCompany extends Model
{
    protected $table = 'proformacompany';

    protected $primaryKey  = 'proformaCompanyId';

    protected $fillable = [
            'companyAlias' ,
            'company' ,
            'address' ,
            'phone' ,
            'email' ,
            'web' ,
            'paymentAccDetailsIsVisible' ,
            'logo' ,
            'signature' ,
            'seal' ,
            'watermarkLogo' ,
            'footerBackground' ,

			'created_at',
            'updated_at',
    ];

    protected $casts = [
        'proformaCompanyId'=> 'integer',
        
    ];

}




