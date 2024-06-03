<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

class Acquisition extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'property_id',
        'acquisition_status',
        'single_asset_portfolio',
        'portfolio',
        'existing_bedroom_no',
        'asking_price',
        'offer_price',
        'agreed_purchace_price',
        'difference',
        'stamp_duty',
        'acquisition_cost',
        'agent',
        'agent_fee_percentage',
        'agent_fee',
        'bridge_loan',
        'estimated_period',
        'loan_percentage',
        'estimated_interest',
        'estimated_tpc',
        'offer_date',
        'target_completion_date',
        'completion_date',
        'col_status',
        'col_status_log',
        'financing_status',
        'bric_purchase_yield_percentage',
        'tpc_bedspace',
        'purchase_price_bedspace',
        'bric_y1_proposed_rent_pppw',
        'tenancy_length_weeks',
        'tennure',
        'ground_rent',
        'ground_rent_due',
    ];

    protected static $logName = 'Acquisition';
    protected static $logFillable = true;


    public function getDescriptionForEvent(string $eventName): string
    {
        return "Acquisition has been {$eventName} ";
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName == 'updated'){
            $activity->location = "Acquisition Edit Page";
        }
        if($eventName == 'created'){ 
            $activity->location = "Create Acquisition Page";
        }
        if($eventName == 'deleted') {
            $activity->location = "Acquisition Edit Page";
        }

    }
}

?>
