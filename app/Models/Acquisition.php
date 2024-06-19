<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Acquisition extends Model implements Searchable
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
        'agreed_purchase_price',
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
        'capex_budget',
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

    public function getSearchResult(): SearchResult
    {
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->acquisition_status,
            $this->single_asset_portfolio,
            $this->portfolio,
            $this->existing_bedroom_no,
            $this->asking_price,
            $this->offer_price,
            $this->agreed_purchase_price,
            $this->difference,
            $this->stamp_duty,
            $this->acquisition_cost,
            $this->agent,
            $this->agent_fee_percentage,
            $this->agent_fee,
            $this->bridge_loan,
            $this->estimated_period,
            $this->loan_percentage,
            $this->estimated_interest,
            $this->estimated_tpc,
            $this->offer_date,
            $this->target_completion_date,
            $this->completion_date,
            $this->col_status,
            $this->col_status_log,
            $this->financing_status,
            $this->capex_budget,
            $this->bric_purchase_yield_percentage,
            $this->tpc_bedspace,
            $this->purchase_price_bedspace,
            $this->purchase_price_bedspace,
            $this->bric_y1_proposed_rent_pppw,
            $this->tenancy_length_weeks,
            $this->tennure,
            $this->ground_rent,
            $this->ground_rent_due,
        );
    }


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
