<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'address',
        'location',
        'phone1',
        'phone2',
        'phone3',
        'birthday',
        'death_date',
        'gender',
        'civil_status',
        'notes',
        'active',
        /**
         * Family relations
         */
        'spouse_id',
        'father_id',
        'mother_id',
        'mentor_id',
        /**
         * Fk's
         */
        'occupation_id',
        'church_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Relation between a user and the church to which he belongs
     *
     */
    public function church(){
        return $this->hasOne('App\Church');
    }

    /**
     * Relation between a user and his main occupation
     *
     */
    public function occupation(){
        return $this->hasOne('App\Occupation');
    }
}
