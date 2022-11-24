<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProformaInvoiceCommonSettings extends Model
{
    protected $table = 'proformainvoicecommonsettings';

    protected $primaryKey  = 'proformaInvoiceCommonSettingsId';

    protected $fillable = [
            'officeContactTitle' ,
            'proformaInvoiceTitle' ,
            'consigneeTitle' ,
            'traderTitle' ,
            'paymentMediaTitle' ,
            'terms' ,
            'declaration' ,

			'created_at',
            'updated_at',
    ];

    protected $casts = [
        'proformaInvoiceCommonSettingsId'=> 'integer',
        
    ];

}