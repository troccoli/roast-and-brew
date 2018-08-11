<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCafeRequest;
use App\Models\Cafe;
use App\Utilities\GoogleMaps;
use Illuminate\Support\Facades\Auth;

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
        $addedCafes = [];

        $locations = $request->input('locations');

        $firstLocation = array_shift($locations);

        // Create a parent cafe and grab the first location
        $parentCafe = new Cafe();

        $address = $firstLocation['address'];
        $city = $firstLocation['city'];
        $state = $firstLocation['state'];
        $zip = $firstLocation['zip'];
        $locationName = $firstLocation['name'];
        $brewMethods = $firstLocation['methodsAvailable'];

        // Get the Latitude and Longitude returned from the Google Maps Address.
        $coordinates = GoogleMaps::geocodeAddress($address, $city, $state, $zip);

        $parentCafe->name = $request->input('name');
        $parentCafe->location_name = $locationName ?? '';
        $parentCafe->address = $address;
        $parentCafe->city = $city;
        $parentCafe->state = $state;
        $parentCafe->zip = $zip;
        $parentCafe->latitude = $coordinates['lat'];
        $parentCafe->longitude = $coordinates['lng'];
        $parentCafe->roaster = $request->has('roaster');
        $parentCafe->website = $request->input('website');
        $parentCafe->description = $request->input('description') ?? '';
        $parentCafe->added_by = Auth::user()->id;

        $parentCafe->save();

        // Attach the brew methods
        $parentCafe->brewMethods()->sync($brewMethods);

        array_push($addedCafes, $parentCafe->toArray());

        // Now that we have the parent cafe, we add all of the other locations.
        // We have to see if other locations are added.
        foreach ($locations as $location) {
            // Create a cafe and grab the location
            $cafe = new Cafe();

            $address = $location['address'];
            $city = $location['city'];
            $state = $locations['state'];
            $zip = $locations['zip'];
            $locationName = $locations['name'];
            $brewMethods = $locations['methodsAvailable'];

            // Get the Latitude and Longitude returned from the Google Maps Address.
            $coordinates = GoogleMaps::geocodeAddress($address, $city, $state, $zip);

            $cafe->parent = $parentCafe->id;
            $cafe->name = $request->input('name');
            $cafe->location_name = $locationName ?? '';
            $cafe->address = $address;
            $cafe->city = $city;
            $cafe->state = $state;
            $cafe->zip = $zip;
            $cafe->latitude = $coordinates['lat'];
            $cafe->longitude = $coordinates['lng'];
            $cafe->roaster = $request->has('roaster');
            $cafe->website = $request->input('website');
            $cafe->description = $request->input('description') ?? '';
            $cafe->added_by = Auth::user()->id;

            $cafe->save();

            // Attach the brew methods
            $cafe->brewMethods()->sync($brewMethods);

            array_push($addedCafes, $cafe->toArray());
        }

        return response()->json($addedCafes, 201);
    }
}
