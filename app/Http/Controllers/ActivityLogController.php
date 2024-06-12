<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use \Spatie\Activitylog\Models\Activity;
use DataTables;

class ActivityLogController extends Controller
{
    public function getAllActivity()
    {
        // $activity = ActivityLog::getAllActivity();

        $activity = DB::table('spatie_activity_log')
        ->leftJoin('users', 'spatie_activity_log.causer_id', '=', 'users.id')
        ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
        ->select(
            'spatie_activity_log.id AS id',
            'roles.role',
            DB::raw("CONCAT_WS(' ', users.first_name, users.middle_name, users.last_name) AS user_name"),
            'spatie_activity_log.description',
            'spatie_activity_log.location',
            'spatie_activity_log.created_at',
            'spatie_activity_log.properties',
        )->orderBy('created_at','desc')->get();

        /* This is the code that is being used to return the data to the datatable. */
        return Datatables::of($activity)
                ->addIndexColumn()
                ->make(true);
        
    }
    public function viewActivityDetails($id){

        $activity = Activity::where('id', $id)->first();
        $changed = map_activity_log_keys($activity->properties);
        $results = search_database('completed');
        // Log::info($results);
        return view('setting\activity-details', ['details' => $activity , 'changes' => $changed]);
 

    }
}
