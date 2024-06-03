<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

class OperationInsurance extends Model
{
    use HasFactory;
    use LogsActivity;

    protected static $logName = 'Operation Insurance';
    protected static $logFillable = true;


    public function getDescriptionForEvent(string $eventName): string
    {
        return "Operation Insurance has been {$eventName} ";
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName == 'updated'){
            $activity->location = "Operation Insurance Edit Page";
        }
        if($eventName == 'created'){ 
            $activity->location = "Create Operation Insurance Page";
        }
        if($eventName == 'deleted') {
            $activity->location = "Operation Insurance Edit Page";
        }

    }
}
