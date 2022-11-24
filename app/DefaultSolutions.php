<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultSolutions extends Model
{
    protected $table = 'defaultsolutions';

    protected $primaryKey  = 'defaultSolutionId';

    protected $fillable = [
            'defaultSolution' ,
            'defaultSolutionCN' ,
			'defaultSolutionRU' ,
			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'defaultSolutionId'=> 'integer',
    ];

}

