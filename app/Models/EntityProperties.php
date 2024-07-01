<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

class EntityProperties extends Model
{
    use HasFactory;
    use LogsActivity;

    protected static $logName = 'Entity Properties';
    protected static $logFillable = true;

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Entity Properties has been {$eventName} ";
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName == 'updated'){
            $activity->location = "Entity Properties Edit Page";
        }
        if($eventName == 'created'){ 
            $activity->location = "Create Entity Properties Page";
        }
        if($eventName == 'deleted') {
            $activity->location = "Entity Properties Edit Page";
        }

    }
}
