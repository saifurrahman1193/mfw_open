<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class MailSettings extends Model
{
    protected $table = 'mailsettings';
    protected $primaryKey  = 'mailSettingsId';
    protected $fillable = [
            'mail' ,
            'contactMails' ,
            'numberTitle' ,
            'number' ,
            'logo' ,
            'website' ,

			'created_at',
            'updated_at',
    ];

    protected $casts = [
        'mailSettingsId'=> 'integer',

        
    ];

}
