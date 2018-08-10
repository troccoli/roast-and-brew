<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrewMethod extends Model
{
    protected $fillable = ['method'];

    public function cafes()
    {
        // Need to specify the table name as the default wold be 'brew_method_cafe'
        return $this->belongsToMany(Cafe::class, 'cafes_brew_methods');
    }
}
