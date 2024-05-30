<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Development;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Log;

class DevelopmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = Property::filter();

        if ($request->ajax()) {

            $developments = Development::getDevelopment($request);

            /* This is the code that is being used to return the data to the datatable. */
            return Datatables::of($developments)
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('development.index', compact('filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $data = Development::editDevelopment($id);
        return view('development.edit', compact('data'));
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
        $propertyID = Development::select('property_id')->where('developments.id', $id)->first();
        // Log::info($propertyID->property_id);
        if ($request->ajax()) {
            $development =  Development::updateDevelopment($request, $id);
            return [
                "status" => 1,
                "data" => 'Success',
                "id" => $propertyID->property_id,
            ];
        }
    }
    public function updateHsDevelopment(Request $request, $id)
    {
        if ($request->ajax()) {
            $development =  Development::updateHsDevelopment($request, $id);
            return [
                "status" => 1,
                "data" => 'Success',
            ];
        }
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
