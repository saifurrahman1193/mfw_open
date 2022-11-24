<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'notifications';

    protected $primaryKey  = 'notificationId';

    protected $fillable = [
            'receiverId' ,

            'genericBrandId', // for price setup
          


            'message' ,
            'read_at' ,
            

            
			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'notificationId'=> 'integer',
        'receiverId'=> 'integer',
        'genericBrandId'=> 'integer',
        
    ];

}

