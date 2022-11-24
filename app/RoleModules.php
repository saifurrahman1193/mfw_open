<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleModules extends Model
{

    protected $table = 'rolemodules';

    protected $primaryKey  = 'rolemoduleId';


    protected $fillable = [
              'roleId',
			  'moduleId',
              'created_at',
              'updated_at'

    ];


    protected $casts = [
        'userRoleId'=> 'integer',
        'moduleId'=> 'integer',
        'roleId'=> 'integer',
    ];


}
