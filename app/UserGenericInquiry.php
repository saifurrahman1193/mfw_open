<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGenericInquiry extends Model
{
    protected $table = 'usergenericinquiry';

    protected $primaryKey  = 'userGenericInquiryId';

    protected $fillable = [
            'genericBrandId' ,
            'inquirerId',
            'prescriptionPath',
            'message',
            'genericStrengths',
            'packTypes',
            'batch',
            'genericPackSizeId',
            'isPrescription',
            'message',



			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'userGenericInquiryId'=> 'integer',
        'genericBrandId'=> 'integer',
        'inquirerId'=> 'integer',
        'batch'=> 'integer',
        'genericPackSizeId'=> 'integer',
        'isPrescription'=> 'integer',
    ];

}


