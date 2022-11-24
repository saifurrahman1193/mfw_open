<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{

    protected $table = 'roles';

    protected $primaryKey  = 'roleId';


    protected $fillable = [
			  'role',
			  'description',
              'created_at',
              'updated_at'

    ];


    protected $casts = [
        'roleId'=> 'integer'
    ];


}
