<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
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
}
