<?php

namespace App\Models;

use App\ActivityLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class Log extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'property_id',
        'user_id',
        'type',
        'description',
    ];

    public function saveLogs($request){
        $userID = Auth::user()->id;

        $notes = new Log();
        $notes->property_id = $request['formData']['pid'];
        $notes->user_id = $userID;
        $notes->type = $request['formData']['type'];
        $notes->description = $request['formData']['log_details'];
        $notes->save();

        // save activity log here
        insertActivityLog($userID, 'Added log on '.ucfirst($notes->type).' page', ucfirst($notes->type).' Page');
        
        return $notes;
    }

    public function getLogs($request){
        $logs = DB::table('logs')
        ->leftJoin('users','logs.user_id', '=', 'users.id')
        ->selectRaw("users.first_name, users.middle_name, users.last_name, logs.*")
        ->where('logs.property_id', $request['pid']);
        if ($request['type']) {
            $logs = $logs->where(function($t) use ($request) {
                $t->orWhere('logs.type', '=', $request['type']);
            }); 
        }
        $logs = $logs->orderBy('id', 'DESC')->get();
        return $logs;
    }

    public function getSingleLogs($request, $id){
        $logs = DB::table('logs')
        ->leftJoin('users','logs.user_id', '=', 'users.id')
        ->selectRaw("users.first_name, users.middle_name, users.last_name, logs.*")
        ->where('logs.id', $id)->first();
        return $logs;
    }

    public function updateLogs($request, $id){
        $userID = Auth::user()->id;

        $logs = Log::find($id);
        $logs->user_id = $userID;
        $logs->description = $request['formData']['update_log_details'];
        $logs->save();
        $logs->touch();


        $logs = DB::table('logs')
        ->leftJoin('users','logs.user_id', '=', 'users.id')
        ->selectRaw("users.first_name,' ',users.middle_name,' ',users.last_name ,logs.*")
        ->where('logs.id', $id)->first();
        return $logs;
    }

    public function removeLogs($id){
        $logs = Log::where('id', '=', $id)->delete();
        return $logs;
    }
}
