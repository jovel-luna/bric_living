<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DataTables;

class SearchController extends Controller
{
    public function searchterm(Request $request)
    {
        Log::info($request);
        Log::info($request->input('query'));
        $offset = 0;
        // $draw = $request->input('draw');

        if ($request->input('query') == null) {
            $term = ' ';
        }
        else {
            $term = $request->input('query');
        }
        $results = search_database($term, $offset);


        Log::info($results);
        $count = $results->count();
 
        return view('setting.advanced-search-results', compact('results', 'count', 'term'));
    }
}
