<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierSocialMedia extends Model
{
    protected $table = 'suppliersocialmedia';

    protected $primaryKey  = 'supplierSocialMediaId';

    protected $fillable = [
            'supplierId' ,
            'socialMediaId' ,
            'supplierSocialNameOrId' ,
			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'supplierSocialMediaId'=> 'integer',
        'supplierId'=> 'integer',
        'socialMediaId'=> 'integer',
    ];

}

