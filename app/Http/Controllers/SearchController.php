<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DataTables;

class SearchController extends Controller
{
    public function searchterm(Request $request)
    {
        $offset = $request->input('start');
        $draw = $request->input('draw');
        // Log::info($offset);
        // Log::info($request);
        if ($request->has('search.value')) {
            $term = $request->input('search.value');
        } else {
            $term = ' ';
        }

        $totalRecords = search_database_count($term);
        $results = search_database($term, $offset);
        $recordsFiltered = search_database_count_filtered($term, $offset);

        // return Datatables::of($results)
        //     ->addIndexColumn()
        //     ->make(true);

        return response()->json([
            'draw' => $draw,
            'recordsTotal' =>  $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $results,
        ]);
    }
}
