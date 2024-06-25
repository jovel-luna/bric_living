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
            $this->budget_year,
            $this->hmo_license_fee,
            $this->hmo_license_period,
            $this->hmo_fee_per_year,
            $this->maintenance_property_year,
            $this->maintenance_bed_year,
            $this->gas_property_year,
            $this->gas_bed_year,
            $this->electric_property_year,
            $this->electric_bed_year,

            $this->water_property_year,
            $this->water_bed_year,
            $this->internet_property_year,
            $this->internet_bed_year,
            $this->tv_license_per_house,
            $this->property_insurance_annual_cost,
            $this->total_opex_budget,

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
