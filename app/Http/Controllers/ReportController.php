<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Location;
use App\Models\Property;
use App\Models\LettingStatus;
use App\Models\EntityProperties;

use App\Exports\ReportsExports;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = Entity::all();
        $locations = Location::all();
        $letting_status = LettingStatus::all();
        return view('report.index', compact('entities' , 'locations' , 'letting_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info($request);
        $entities = $request->entities;

        $properties = null;
        
        if ($request->has('entities')){
            $properties = Property::whereHas('entity_properties', function ($query) use ($entities) {
                $query->whereIn('entity_id', $entities);
            })->with('entity_properties');
        }
        else {
            $properties = Property::with('entity_properties');
        }



        $properties = $properties->get();
        return Excel::download(new ReportsExports($properties), 
        'reports.csv', \Maatwebsite\Excel\Excel::CSV);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
