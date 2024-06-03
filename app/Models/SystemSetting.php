<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

class SystemSetting extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'system_logo',
        'system_name',
    ];

    protected static $logName = 'System Setting';
    protected static $logFillable = true;


    public function getDescriptionForEvent(string $eventName): string
    {
        return "System Setting has been {$eventName} ";
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName == 'updated'){
            $activity->location = "System Setting Edit Page";
        }
        if($eventName == 'created'){ 
            $activity->location = "Create System Setting Page";
        }
        if($eventName == 'deleted') {
            $activity->location = "System Setting Edit Page";
        }

    }


    public function updateLogoImage($logoPath, $id){
        DB::table('system_settings')
        ->where('system_settings.id', '=', $id)
        ->update([
            'system_settings.system_logo' => $logoPath,
        ]);
    }
}
