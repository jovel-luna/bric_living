<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

class LettingStatus extends Model
{
    use HasFactory;

    use LogsActivity;

    protected $fillable = [
        'letting_status_name',
    ];

    protected static $logName = 'Letting Status';
    protected static $logFillable = true;


    public function getDescriptionForEvent(string $eventName): string
    {
        return "Letting Status has been {$eventName} ";
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName == 'updated'){
            $activity->location = "Letting Status Edit Page";
        }
        if($eventName == 'created'){ 
            $activity->location = "Create Letting Status Page";
        }
        if($eventName == 'deleted') {
            $activity->location = "Letting Status Edit Page";
        }

    }
}
