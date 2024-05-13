<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $filters = Property::filter();
        if ($request->ajax()) {
            $properties = Property::getProperty($request);
            /* This is the code that is being used to return the data to the datatable. */
            return Datatables::of($properties)
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('home', compact('filters'));
    }
}
