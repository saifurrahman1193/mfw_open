<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceCommonSettings extends Model
{
    protected $table = 'invoicecommonsettings';

    protected $primaryKey  = 'invoiceCommonSettingId';

    protected $fillable = [
            'invoiceTitle' ,
            'commentTitle' ,
            'declaration' ,

			'created_at',
            'updated_at',
    ];

    protected $casts = [
        'invoiceCommonSettingId'=> 'integer',
        
    ];

}
