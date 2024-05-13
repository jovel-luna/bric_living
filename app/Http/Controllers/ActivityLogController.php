<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use DataTables;

class ActivityLogController extends Controller
{
    public function getAllActivity()
    {
        $activity = ActivityLog::getAllActivity();

        /* This is the code that is being used to return the data to the datatable. */
        return Datatables::of($activity)
                ->addIndexColumn()
                ->make(true);
        
    }
}
