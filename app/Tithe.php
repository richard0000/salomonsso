<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Tithe extends Model
{
    use Searchable;
    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'amount',
        'date',
        'user_id'
    ];
    /**
     * Searchable fields
     *
     */
    protected $search_bindings = ['date', 'user_id'];

    /**
     * Relation between a tithe and his member
     *
     */
    public function member()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
