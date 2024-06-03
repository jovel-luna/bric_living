<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;


class Admin extends Model
{
    use HasFactory;
    use LogsActivity;

    protected static $logName = 'Admin';
    protected static $logFillable = true;


    public function getDescriptionForEvent(string $eventName): string
    {
        return "Admin has been {$eventName} ";
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName == 'updated'){
            $activity->location = "Admin Edit Page";
        }
        if($eventName == 'created'){ 
            $activity->location = "Create Admin Page";
        }
        if($eventName == 'deleted') {
            $activity->location = "Admin Edit Page";
        }

    }

}
