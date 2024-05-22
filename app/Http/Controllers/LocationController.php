<?php

namespace App\Http\Controllers;

use App\Models\Location;
use DataTables;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $locations = Location::select(['id', 'postcode', 'city', 'area'])->get();

        if ($request->ajax()) {
            return Datatables::of($locations)
                ->addIndexColumn()
                ->addColumn('checkbox', function($location) {
                    return '<input type="checkbox" class="selectItem" value="" checked>';
                })
                ->rawColumns(['checkbox'])
                ->make(true);
        }

        return view('property_locations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('property_locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Location::create([
            'postcode' => $request->postcode,
            'city' => $request->city,
            'area' => $request->area
            
        ]);

        return view('property_locations.index');
    }

    public function store_new(Request $request){
        $location = Location::create([
            'postcode' => $request->postcode,
            'city' => $request->city,
            'area' => $request->area
            
        ]);

        return [
            "data" => $location,
            "status" => 1,
            "message" => 'Success'
        ];

        // return view('property_locations.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::where('id', $id)->first();

        return view('property_locations.show')->with('location', $location);;
    }

    /**
     * Retrieve Location instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function retrieve_instance(Request $request)
    {
        $location = Location::where('id', $request->id)->first();
        return response()->json([
            'location' => $location
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
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
        $location = Location::find($id);

        if (isset($request->city)) {
            $location->city = $request->city;
        }

        if (isset($request->area)) {
            $location->area = $request->area;
        }

        if (isset($request->postcode)) {
            $location->postcode = $request->postcode;
        }

        $location->save();
        return view('property_locations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::find($id);
        $location->forceDelete();
        
        return view('property_locations.index');
    }
}