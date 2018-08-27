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
}
