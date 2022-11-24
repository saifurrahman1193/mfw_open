<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{

    protected $table = 'userroles';

    protected $primaryKey  = 'userRoleId';


    protected $fillable = [
			  'userId',
			  'roleId',
              'created_at',
              'updated_at'

    ];


    protected $casts = [
        'userRoleId'=> 'integer',
        'userId'=> 'integer',
        'roleId'=> 'integer',
    ];


}
