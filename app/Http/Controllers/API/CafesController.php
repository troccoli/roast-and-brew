<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCafeRequest;
use App\Models\Cafe;
use App\Utilities\GoogleMaps;

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
        return response()->json(Cafe::with('brewMethods')->get());
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
        return response()->json(Cafe::find($id)->with('brewMethods')->first());
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
        // Get the Latitude and Longitude returned from the Google Maps Address.
        $coordinates = GoogleMaps::geocodeAddress(
            $request->input('address'),
            $request->input('city'),
            $request->input('state'),
            $request->input('zip')
        );

        $cafe = new Cafe();

        $cafe->name = $request->input('name');
        $cafe->address = $request->input('address');
        $cafe->city = $request->input('city');
        $cafe->state = $request->input('state');
        $cafe->zip = $request->input('zip');
        $cafe->latitude = $coordinates['lat'];
        $cafe->longitude = $coordinates['lng'];

        $cafe->save();

        return response()->json($cafe, 201);
    }
}
