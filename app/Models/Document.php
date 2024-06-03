<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

class Document extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'type',
        'file_name',
        'file_path',
        'file_type',
        'file_date'
    ];

    protected static $logName = 'Document';
    protected static $logFillable = true;


    public function getDescriptionForEvent(string $eventName): string
    {
        return "Document has been {$eventName} ";
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName == 'updated'){
            $activity->location = "Document Edit Page";
        }
        if($eventName == 'created'){ 
            $activity->location = "Create Document Page";
        }
        if($eventName == 'deleted') {
            $activity->location = "Document Edit Page";
        }

    }
}
