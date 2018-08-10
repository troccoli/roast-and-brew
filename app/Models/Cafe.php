<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    protected $fillable = ['name', 'address', 'city', 'state', 'zip'];

    public function brewMethods()
    {
        // Need to specify the table name as the default wold be 'brew_method_cafe'
        return $this->belongsToMany(BrewMethod::class, 'cafes_brew_methods');
    }
}
