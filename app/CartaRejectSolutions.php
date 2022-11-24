<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartaRejectSolutions extends Model
{
    protected $table = 'cartarejectsolutions';

    protected $primaryKey  = 'cartRejectSolutionId';

    protected $fillable = [
     
            'solution' ,
            'solutionCN' ,
            'solutionRU' ,

            'cartId' ,


			'created_at',
            'updated_at',
    ];

    protected $casts = [
        'cartRejectSolutionId'=> 'integer',
        'cartId'=> 'integer',
        
        
    ];

}

