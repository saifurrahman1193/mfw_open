<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batchpictures extends Model
{
    protected $table = 'batchpictures';

    protected $primaryKey  = 'batchPictureId';

    protected $fillable = [
            'picPath' ,
            'cartDetailId' ,

			'created_at',
            'updated_at'
    ];

    protected $casts = [
        'batchPictureId'=> 'integer',
        'cartDetailId'=> 'integer',
    ];

}

