<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Generic extends Model
{
    protected $table = 'generic';

    protected $primaryKey  = 'genericId';

    protected $fillable = [
            'genericName' ,
            'genericNameCN' ,
            'genericNameRU' ,
            'dosageFormId' ,
            'globalTradeNameCompany' ,
            'globalTradeNameCompanyCN' ,
            'globalTradeNameCompanyRU' ,
            'usesFor' ,
            'usesForCN' ,
            'usesForRU' ,
            'dosingDetails' ,
            'dosingDetailsCN' ,
            'dosingDetailsRU' ,
			'avgPriceOfOriginator' ,
			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'genericId'=> 'integer',
        'dosageFormId'=> 'integer',
        'avgPriceOfOriginator'=> 'double',
    ];

}


