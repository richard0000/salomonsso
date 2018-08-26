<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Church extends Model
{
    use Searchable;
    /**
     * Fields that are mapped in database
     *
     */
    protected $fillable = [
        'name',
        'address',
        'location',
        'phone1',
        'phone2',
        'phone3',
        'email',
        'logo',
        'pastor_id',
    ];

    /**
     * Relation between a church and his pastor
     *
     */
    public function pastor()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    /**
     * Relation between a church and its related members
     *
     */
    public function members()
    {
        return $this->hasMany('App\User');
    }
}
