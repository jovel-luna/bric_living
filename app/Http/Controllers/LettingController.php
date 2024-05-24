<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Property;
use App\Models\Development;
use App\Models\Letting;
use DataTables;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class LettingController extends Controller
{

    public function contractList(Request $request) {

        if ($request->ajax()) {

            $contracts = Letting::getContracts($request);

            /* This is the code that is being used to return the data to the datatable. */
            return Datatables::of($contracts)
                    ->addIndexColumn()
        
                    ->make(true);

         }

        return view('entity.contract_list.index');
    }

    public function showContractInfo($id) {
        return view('entity.contract_list.show');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = Property::filter();
        // dd($filters['letting_status'][0]->letting_status_name);
        if ($request->ajax()) {

            $lettings = Letting::getLettings($request);

            /* This is the code that is being used to return the data to the datatable. */
            return Datatables::of($lettings)
                    ->addIndexColumn()
                    ->setRowId(function ($lettings) {
                        return $lettings->id;
                    })
                    ->make(true);
        }
        return view('letting.index', compact('filters'));
    }

    public function lettingsHistory(Request $request)
    {
        $filters = Property::filter();
        // dd($filters['letting_status'][0]->letting_status_name);
        if ($request->ajax()) {

            $lettings = Letting::getLettingsHistory($request);

            /* This is the code that is being used to return the data to the datatable. */
            return Datatables::of($lettings)
                    ->addIndexColumn()
                    ->setRowId(function ($lettings) {
                        return $lettings->id;
                    })
                    ->make(true);
        }
        return view('letting.index-history', compact('filters'));
    }

    public function bulkUpdateLettings(Request $request)
    {
        try {
            $lettings = Letting::bulkUpdateLettings($request);
            return [
                "status" => 1,
                "data" => 'Success'
            ];
        }  catch (\Throwable $th) { 
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 200);
        }  
    }
    public function unarchive(Request $request)
    {
        try {
            $lettings = Letting::unarchive($request);
            return [
                "status" => 1,
                "data" => 'Success'
            ];
        }  catch (\Throwable $th) { 
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 200);
        }  
    }
    public function bulkArchiveLettings(Request $request)
    {
        try {
            $lettings = Letting::bulkArchiveLettings($request);
            return [
                "status" => 1,
                "data" => 'Success'
            ];
        }  catch (\Throwable $th) { 
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 200);
        }  
    }
    public function updateLettings(Request $request)
    {
        try {
            $lettings = Letting::updateLettings($request);
            return [
                "status" => 1,
                "data" => 'Success'
            ];
        }  catch (\Throwable $th) { 
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 200);
        }  
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
        $letting = Letting::findorfail($id);
        return view('letting.edit', [
            'data' => $letting
        ]);
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
