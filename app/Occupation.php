<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    /**
     * Campos a manejar por el objeto a mapear
     *
     */
    protected $fillable = [
        'description',
        'created_at',
        'updated_at'
    ];
}
