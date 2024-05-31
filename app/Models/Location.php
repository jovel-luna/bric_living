<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

class Location extends Model
{
    use LogsActivity;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'postcode',
        'city',
        'area'
    ];
    protected static $logName = 'Location';
    protected static $logFillable = true;


    public function getDescriptionForEvent(string $eventName): string
    {
        return "Location has been {$eventName} ";
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName == 'updated'){
            $activity->location = "Location Edit Page";
        }
        if($eventName == 'created'){ 
            $activity->location = "Create Location Page";
        }
        if($eventName == 'deleted') {
            $activity->location = "Location Edit Page";
        }

    }

    public function import($data){
        foreach ($data[0] as $pck => $pcVal) {
            $location = new Location();
            $location->postcode = $pcVal[0];
            $location->area = $pcVal[1];
            $location->city = $pcVal[2];
            $location->save();
        }
        return true;
    }
}
