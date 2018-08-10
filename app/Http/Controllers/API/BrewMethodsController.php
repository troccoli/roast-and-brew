<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BrewMethod;

class BrewMethodsController extends Controller
{
    public function getBrewMethods()
    {
        return response()->json(BrewMethod::all());
    }
}
