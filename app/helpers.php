<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Property;
use App\Models\Acquisition;
use App\Models\UserAccess;
use Illuminate\Support\Facades\Log;
use Spatie\Searchable\Search;
use Spatie\Searchable\ModelSearchAspect;

if (!function_exists('user_email')) {
    function user_email()
    {
        $user = Auth::user();

        return $user->email;
    }
}

if (!function_exists('role_list')) {
    function role_list()
    {
        $roles = DB::table('roles')
            ->select('id', 'role')
            ->get();
        return $roles;
    }
}

if (!function_exists('hasAccess')) {
    function hasAccess($type)
    {
        if (Auth::check()) {
            $access = UserAccess::checkAccess($type);
            return $access;
        } else {
            return json_encode(false);
        }
    }
}

if (!function_exists('checkRole')) {
    function checkRole()
    {
        $userid = Auth::user()->id;
        $acquisition = User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->selectRaw('roles.role')
            ->where('users.id', '=', $userid)
            ->first();
        return $acquisition->role;
    }
}
if (!function_exists('getSettings')) {
    function getSettings($type)
    {
        $portalSettings = DB::table('system_settings')
            ->select('*')
            ->where('system_settings.id', '=', 1)
            ->first();

        switch ($type) {
            case 'portal-title':
                return $portalSettings->system_name;
                break;
            case 'portal-logo':
                return $portalSettings->system_logo;
                break;
        }
    }
}

if (!function_exists('insertActivityLog')) {
    function insertActivityLog($id, $description, $location, $type = "Not Specified")
    {
        $log = new ActivityLog();
        $log->user_id = $id;
        $log->description = $description;
        $log->location = $location;
        $log->type = $type;
        $log->save();

        return $log->id;
    }
}
if (!function_exists('format_date')) {
    function format_date($data)
    {
        if ($data) {
            if (gettype($data) == 'double') {
                $dateFormat = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data)->format('d-m-Y');
            } else {
                $dateFormat = $data;
            }
        } else {
            $dateFormat = null;
        }

        return $dateFormat;
    }
}

if (!function_exists('number_abv')) {
    function number_abv($data)
    {
        $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
        if ((($data % 100) >= 11) && (($data % 100) <= 13))
            return $data . 'th';
        else
            return $data . $ends[$data % 10];
    }
}


if (!function_exists('map_activity_log_keys')) {
    function map_activity_log_keys($collection)
    {
        $changed = $collection->map(function ($item, $key) {
            // Declare Array Map Keys
            $keyMappings = [
                'old' => 'Old Data',
                'attributes' => 'New Data',
                // Location
                'area'  => 'Area',
                'city'  => 'City',
                'postcode'  => 'Postcode',
                // Acquisition
                'acquisition_status' => 'Acquisition Status',
                'single_asset_portfolio' => 'Single Asset / Portfolio',
                'portfolio' => 'Portfolio',
                'existing_bedroom_no' => 'Existing Bedroom No.',
                'asking_price' => 'Asking Price',
                'offer_price' => 'Offer Price',
                'agreed_purchace_price' => 'Agreed Purchase Price',
                'difference' => 'Difference',
                'stamp_duty' => 'Stamp Duty',
                'acquisition_cost' => 'Acquisition Cost',
                'agent' => 'Agent',
                'agent_fee_percentage' => 'Agent Fee % (excl. VAT):',
                'agent_fee' => 'Agent Fee',
                'bridge_loan' => 'Bridge Loan',
                'estimated_period' => 'Estimated bridge loan period (months):',
                'loan_percentage' => 'Bridge Loan %',
                'estimated_interest' => 'Estimated Interest',
                'estimated_tpc' => 'Estimated TPC',
                'offer_date' => 'Offer Date',
                'target_completion_date' => 'Target Completion Date',
                'completion_date' => 'Completion Date',
                'col_status' => 'COL Status',
                'col_status_log' => 'COL Status Log',
                'financing_status' => 'Financing Status',
                'capex_budget' => 'CAPEX Bugdet',
                'bric_purchase_yield_percentage' => 'Valuation Yield %',
                'tpc_bedspace' => 'TPC / Bed Space',
                'purchase_price_bedspace' => 'Purchase Price / Bed Space',
                'bric_y1_proposed_rent_pppw' => 'Bric Y1 proposed rent PPPW',
                'tenancy_length_weeks' => 'Tenancy length (weeks)',
                'tennure' => 'Tennure',
                'ground_rent' => 'Ground Rent',
                'ground_rent_due' => 'Ground Rent Due',
                // Development
                'existing_beds' => 'Existing Beds',
                'existing_stories' => 'Existing Stories',
                'bric_stories' => 'Bric Stories',
                'bric_beds' => 'Bric Beds',
                'project_start_date' => 'Project Start Date',
                'projected_completion_date' => 'Projected Completion Date',
                'over_running' => 'Over running',
                'development_status' => 'Development Status',
                'pc_company' => 'Company (Principal Contractor)',
                'pc_name' => 'Name (Principal Contractor)',
                'pc_mobile' => 'Mobile (Principal Contractor)',
                'pc_email' => 'Email (Principal Contractor)',
                'bc_company' => 'Company (Building Control)',
                'bc_name' => 'Name (Building Control)',
                'bc_mobile' => 'Mobile (Building Control)',
                'bc_email' => 'Email (Building Control)',
                'overall_budget' => 'Overall Budget',
                'actual_spend' => 'Actual Spend',
                // Operations

                // Letting
                'version' => 'Version',
                'property_contract_status' => 'Property Contract Status',
                'target_weekly_rent' => 'Target Weekly Rent',
                'achieved_weekly_rent' => 'Achieved Weekly Rent',
                'floorplan' => 'Floorplan',
                'date_of_refurb' => 'Date of Refurb',
                'tv' => 'TV',
                'archive' => 'Archive',
                // Finance
                'cm_mortgage_status' => 'Mortage Status (Current Mortgage)',
                'cm_provider' => 'Provider (Current Mortgage)',
                'cm_account_no' => 'Account No (Current Mortgage)',
                'cm_start_date' => 'Start Date (Current Mortgage)',
                'cm_expiration_date' => 'Expiration Date (Current Mortgage)',
                'cm_loan_period' => 'Loan Period (Current Mortgage)',
                'cm_current_valuation' => 'Current Valuation (Current Mortgage)',
                'cm_loan_amount' => 'Loan Amount (Current Mortgage)',
                'cm_loan' => 'Loan (Current Mortgage)',
                'cm_interest_rate' => 'Interest Rate (Current Mortgage)',
                'cm_monthly_repayments' => 'Monthly Repayments (Current Mortgage)',
                'cm_monthly_payment_date' => 'Monthly Payment Date (Current Mortgage)',
                'm_provider' => 'Provider (Mortgage)',
                'm_account_no' => 'Account No (Mortgage)',
                'm_start_date' => 'Start Date (Mortgage)',
                'm_expiration_date' => 'Expiration Date (Mortgage)',
                'm_loan_period' => 'Loan Period (Mortgage)',
                'm_estimated_loan' => 'Estimated Loan (Mortgage)',
                'm_agreed_loan' => 'Agreed Loan (Mortgage)',
                'm_estimated_equity_release' => 'Estimated Equity Release (Mortgage)',
                'm_equity_release' => 'Equity Release (Mortgage)',
                'm_loan' => 'Loan (Mortgage)',
                'm_start_fixed_rate_period' => 'Start Fixed Rate Period (Mortgage)',
                'm_end_fixed_rate_period' => 'End Fixed Rate Period (Mortgage)',
                'm_monthly_repayment' => 'Monthly Repayment (Mortgage)',
                'm_monthly_payment_date' => 'Monthly Payment Date (Mortgage)',

                // Tenant
                'name' => 'Name',
                'source' => 'Source',
                'tenant_contract_status' => 'Tenant Contract Status',
                'id_certified' => 'ID Certified',
                'poa' => 'POA',
                'deposits_paid' => 'Deposits Paid',
                'document_outstanding' => 'Document Outstanding',

                // Property
                'property_phase' => 'Property Phase',
                'city' => 'City',
                'area' => 'Area',
                'house_no_or_name' => 'House No / Name',
                'street' => 'Street',
                'postcode' => 'Postcode',
                'no_bric_beds' => 'No. of Bric Beds',
                'gas_provider' => 'Gas Provider',
                'no_bric_bathrooms' => 'No. of Bric Bathrooms',
                'purchase_date' => 'Purchase Date',
                'status' => 'Status',

                // Logs
                'type' => 'Type',
                'description' => 'Description',

            ];

            // Iterate through the top-level keys
            foreach ($item as $subkey => $subValue) {
                // If the key is found in the mappings, replace it
                if (array_key_exists($subkey, $keyMappings)) {
                    $item[$keyMappings[$subkey]] = $subValue;
                    unset($item[$subkey]); // Remove the old key
                }
            }

            return $item;
        });

        return $changed;
    }
}

if (!function_exists('search_database_count')) {
    function search_database_count($query)
    {
        $count = DB::select(
            "
        select count(*) as count
        
        from properties
       
        ",


            ['query' => $query, 'query2' => $query]
        );
        Log::info($count[0]->count);
        return $count[0]->count;
    }
}

if (!function_exists('search_database_count_filtered')) {
    function search_database_count_filtered($query, $offset)
    {
        $count = DB::select(
            "
        select count(*) as count
        
        from properties, locations, acquisitions, developments 
        where match(street) against (:query IN NATURAL LANGUAGE MODE) 
        AND properties.id = acquisitions.property_id
        AND properties.location_id = locations.id
        AND acquisitions.property_id = developments.property_id 
         
        OR MATCH (developments.development_status) AGAINST (:query2 IN NATURAL LANGUAGE MODE) 
        AND properties.id = acquisitions.property_id 
        AND acquisitions.property_id = developments.property_id 

        ",


            ['query' => $query, 'query2' => $query]
        );
        Log::info('search_database_count_filtered count');
        Log::info($count);
        return $count[0]->count;
    }
}

if (!function_exists('search_database')) {
    function search_database($query, $offset)
    {
        // Or an array of model attributes
        $searchResults = (new Search())
            ->registerModel(Property::class, [
                'property_phase',
                'house_no_or_name',
                'street',
                'no_bric_beds',
                'no_bric_bathrooms',
                'purchase_date',
                'status',
            ])
            ->registerModel(Acquisition::class, [
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
            ], function(ModelSearchAspect $modelSearchAspect){
                $modelSearchAspect->hasOne(Property::class);
            })
            ->search($query);

        return $searchResults;
    }
}
