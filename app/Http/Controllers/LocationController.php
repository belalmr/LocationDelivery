<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\LocationMain;
use Bodunde\GoogleGeocoder\Geocoder;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

        public function index()
        {
            $location = Location::all();
            $title = "Show Location Details: ";
            return view('location_index', compact(['title', 'location', 'paginat']));
        }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('location_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->isMethod('post')) {
            $MapLat = $request->input('latitude');
            $MapLng = $request->input('longitude');
            $titleLocation = $request->input('title');

            $location = new Location();
            $location->title = $titleLocation;
            $location->MapLat = $MapLat;
            $location->MapLng = $MapLng;
            $location->distance = $this->calcDistance($MapLat, $MapLng);
            $location->distance_price = $this->calcPrice($MapLat, $MapLng);

            $location->save();
            return redirect(route('location.index', $location->id))->with(['status' => 'Add New Location Successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::find($id);
        $title = "Show Location Details: " . $location->title;
        return view('location.show', compact(['title', 'location']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //    
    }

    private function calcDistance($MapLat, $MapLng)
    {
        $mainlocation = LocationMain::find(1);
        $LocationMain = [
            // "lat" => $mainlocation->main_lat,
            // "lng" => $mainlocation->main_lng
            "lat" => 31.521921061170,
            "lng" => 34.43374671135
        ];
        
        $LocationInput = [
            'lat' => $MapLat,
            'lng' => $MapLng
        ];

        $geocoder = new Geocoder();
        $totalDistance = $geocoder->getDistanceBetween($LocationMain, $LocationInput, 'km');
        return $totalDistance;

    }

    //calculate distance price
    private function calcPrice($MapLat, $MapLng)
    {
        //to get main lon & lat
        $mainlocation = LocationMain::find(1);
        $LocationMain = [
            // "lat" => $mainlocation->main_lat,
            // "lng" => $mainlocation->main_lng
            "lat" => 31.521921061170,
            "lng" => 34.43374671135
        ];
        
        $LocationInput = [
            'lat' => $MapLat,
            'lng' => $MapLng
        ];

        $geocoder = new Geocoder();
        $totalDistance = $geocoder->getDistanceBetween($LocationMain, $LocationInput, 'km');
        // 1.5 = price of 1 km
        $distanceTotalPrice = 1.5 * $totalDistance;
        return $distanceTotalPrice;
    }
}
