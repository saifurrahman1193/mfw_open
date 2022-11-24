<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliverySummary extends Model
{
    protected $table = 'deliverysummary';

    protected $primaryKey  = 'deliverySummaryId';

    protected $fillable = [
            'deliveryMethodId' ,
            'deliverySummary',
            'deliverySummaryCN' ,
            'deliverySummaryRU' ,

			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'deliverySummaryId'=> 'integer',
        'deliveryMethodId'=> 'integer',
    ];

}


