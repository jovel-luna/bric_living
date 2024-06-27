<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class OperationInsurance extends Model implements Searchable
{
    use HasFactory;
    use LogsActivity;

    protected static $logName = 'Operation Insurance';
    protected static $logFillable = true;

    public function getSearchResult(): SearchResult
    {
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->insurer ?? '',
            $this->insurance_in_place ?? '',
            $this->insurance_account_no ?? '',
            $this->insurance_value ?? '',
            $this->insurance_annual_cost ?? '',
            $this->insurance_renewal_date ?? '',

        );
    }

    public function property(){
        return $this->belongsTo(Property::class);
    }


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
