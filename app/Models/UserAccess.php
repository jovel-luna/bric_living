<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

class UserAccess extends Model
{
    use HasFactory;

    use LogsActivity;


    protected $fillable = [
        'user_id',
        'can_import',
        'lettings_table_edit',
    ];

    protected static $logName = 'User Access';
    protected static $logFillable = true;


    public function getDescriptionForEvent(string $eventName): string
    {
        return "A User Access has been {$eventName} ";
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName == 'updated'){
            $activity->location = "User Access Edit Page";
        }
        if($eventName == 'created'){ 
            $activity->location = "Create User Access Page";
        }
        if($eventName == 'deleted') {
            $activity->location = "User Access Edit Page";
        }

    }

    public function checkAccess($type)
    {
        $userid = Auth::user()->id;
        $access = DB::table('user_accesses')
            ->select($type)
            ->where('user_accesses.user_id', '=', $userid)
            ->first();
        return json_encode($access->$type == 1 ? true : false);
    }
}
