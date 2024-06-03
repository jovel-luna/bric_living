<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

class Role extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'role'
    ];

    protected static $logName = 'Role';
    protected static $logFillable = true;


    public function getDescriptionForEvent(string $eventName): string
    {
        return "Role has been {$eventName} ";
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName == 'updated'){
            $activity->location = "Role Edit Page";
        }
        if($eventName == 'created'){ 
            $activity->location = "Create Role Page";
        }
        if($eventName == 'deleted') {
            $activity->location = "Role Edit Page";
        }

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
