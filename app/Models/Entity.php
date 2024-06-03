<?php

namespace App\Models;
use App\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

class Entity extends Model
{
    use HasFactory;
    use LogsActivity;


    protected $fillable = [
        'company_registration_number',
        'entity',
        'registered_address',
        'entity_date_created',
        'statement_due_date',
        'financial_year_start_date',
        'financial_year_end_date',
        // 'no_of_properties',
        // 'no_of_beds',
        // 'pipeline',
        // 'current_rent_role',
    ];

    protected static $logName = 'Entity';
    protected static $logFillable = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Entity has been {$eventName} ";
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName == 'updated'){
            $activity->location = "Entity Edit Page";
        }
        if($eventName == 'created'){ 
            $activity->location = "Create Entity Page";
        }
        if($eventName == 'deleted') {
            $activity->location = "Entity Edit Page";
        }

    }

    public function properties(){
        return $this->belongsToMany(Property::class);
    }
    public function getEntities(){
        $entity = DB::table('entities')->select('entities.id as id','entity')->distinct()->orderBy('entity', 'asc')->get();
        return $entity;
    }
}
