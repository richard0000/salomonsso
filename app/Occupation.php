<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Occupation extends Model
{
    use Searchable;
    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'description',
        'created_at',
        'updated_at'
    ];
    /**
     * Searchable fields
     *
     */
    protected $search_bindings = ['description'];
}
