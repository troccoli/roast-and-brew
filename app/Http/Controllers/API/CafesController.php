<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCafeRequest;
use App\Models\Cafe;

class CafesController extends Controller
{
    /**
     * Gets all of the cafes in the application
     * ---------------------------------------------------------------------------
     * URL:         /api/v1/cafes
     * Method:      GET
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCafes()
    {
        return response()->json(Cafe::all());
    }

    /**
     * Gets an individual cafe
     * ----------------------------------------------------------------------------
     * URL:         /api/v1/cafes/{id}
     * Method:      GET
     *
     * @param integer $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCafe($id)
    {
        return response()->json(Cafe::find($id));
    }

    /**
     * Adds a new cafe to the application
     * ----------------------------------------------------------------------------
     * URL:         /api/v1/cafes
     * Method:      POST
     *
     * @param StoreCafeRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postNewCafe(StoreCafeRequest $request)
    {
        $cafe = Cafe::create($request->only(['name', 'address', 'city', 'state', 'zip']));

        return response()->json($cafe, 201);
    }
}
