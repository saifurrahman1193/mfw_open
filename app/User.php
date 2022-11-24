<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    

    protected $primaryKey  = 'id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nameLocalLang',
         'email',
         'password',
         'manualUserPass',
        'countryId',
         'cityTownDivision',
         'stateProvinceRegionDistrict',
         'postalCode',
         'phoneCode',
        'phone',
         'photoPath',
         'streethouse',
         'ip',
         'countrybasedonip',
         'userAgent',
         'isCustomer',
         'socialMedia', 'takingForRelationship', 'patientName',
         'isCreatedByAdmin',
         'isEmailVerified',
         'website'


    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password) 
    {
        return $this->attributes['password'] = bcrypt($password);
        //return $this->attributes['user_pass'] = md5($password); 
    }

    protected $casts = [
        'id'=> 'integer',
        'countryId'=> 'integer',
        'isCreatedByAdmin'=> 'integer',
        'isEmailVerified'=> 'integer',
        
        
    ];

    
}



