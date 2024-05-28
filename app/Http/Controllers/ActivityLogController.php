<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
    public function viewActivityDetails($id){

        $details = DB::table('detailed_activity_logs')->where('log_id' , $id)->get();
        $user_id = DB::table('activity_logs')->select('user_id')->where('id', $id)->first();
        $user = DB::table('users')->select("first_name", "middle_name", "last_name")->where('id', $user_id->user_id)->first();
        $log_summary = DB::table('activity_logs')->select('description', 'location', 'type')->where('id', $id)->first();

        Log::info($details);

        if($log_summary->type == 'CREATE') {
            return view('setting\activity-details', ['details' => $details, 'username' => $user, 'summary' => $log_summary]);
        }
        if($log_summary->type == 'UPDATE'){
            return view('setting\activity-details-update', ['details' => $details, 'username' => $user, 'summary' => $log_summary]);
        }

    }
}
