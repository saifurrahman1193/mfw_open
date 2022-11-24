<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DosageForm extends Model
{
    protected $table = 'dosageform';

    protected $primaryKey  = 'dosageFormId';

    protected $fillable = [
            'dosageForm' ,
            'dosageFormCN' ,
            'dosageFormRU' ,
			'created_at',
            'updated_at'
    ];

    protected $casts = [
        'dosageFormId'=> 'integer',
    ];

}

