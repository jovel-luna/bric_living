<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Development;
use App\Models\OperationUtility;
use App\Models\OperationInsurance;
use App\Models\OperationExpenditure;
use App\Models\OperationBudget;

use App\Models\Finance;
use App\Models\Letting;
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
            ->registerModel(Acquisition::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                ->addSearchableAttribute('acquisition_status') 
                ->addSearchableAttribute('single_asset_portfolio') 
                ->addSearchableAttribute('portfolio') 
                ->addSearchableAttribute('existing_bedroom_no') 
                ->addSearchableAttribute('asking_price') 
                ->addSearchableAttribute('offer_price') 
                ->addSearchableAttribute('agreed_purchase_price') 
                ->addSearchableAttribute('difference') 
                ->addSearchableAttribute('stamp_duty') 
                ->addSearchableAttribute('acquisition_cost') 
                ->addSearchableAttribute('agent') 
                ->addSearchableAttribute('agent_fee_percentage') 
                ->addSearchableAttribute('agent_fee') 
                ->addSearchableAttribute('bridge_loan') 
                ->addSearchableAttribute('estimated_period') 
                ->addSearchableAttribute('loan_percentage') 
                ->addSearchableAttribute('estimated_interest') 
                ->addSearchableAttribute('estimated_tpc') 
                ->addSearchableAttribute('offer_date') 
                ->addSearchableAttribute('target_completion_date') 
                ->addSearchableAttribute('completion_date') 
                ->addSearchableAttribute('col_status') 
                ->addSearchableAttribute('col_status_log') 
                ->addSearchableAttribute('financing_status') 
                ->addSearchableAttribute('capex_budget') 
                ->addSearchableAttribute('bric_purchase_yield_percentage') 
                ->addSearchableAttribute('tpc_bedspace') 
                ->addSearchableAttribute('purchase_price_bedspace') 
                ->addSearchableAttribute('bric_y1_proposed_rent_pppw') 
                ->addSearchableAttribute('tenancy_length_weeks') 
                ->addSearchableAttribute('tennure') 
                ->addSearchableAttribute('ground_rent') 
                ->addSearchableAttribute('ground_rent_due') 
                ->with('property');
            })
            ->registerModel(Development::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                ->addSearchableAttribute('existing_beds') 
                ->addSearchableAttribute('existing_stories') 
                ->addSearchableAttribute('bric_stories') 
                ->addSearchableAttribute('bric_beds') 
                ->addSearchableAttribute('project_start_date') 
                ->addSearchableAttribute('projected_completion_date') 
                ->addSearchableAttribute('over_running') 
                ->addSearchableAttribute('development_status') 
                ->addSearchableAttribute('pc_company') 
                ->addSearchableAttribute('pc_name') 
                ->addSearchableAttribute('pc_mobile') 
                ->addSearchableAttribute('pc_email') 
                ->addSearchableAttribute('bc_company') 
                ->addSearchableAttribute('bc_name') 
                ->addSearchableAttribute('bc_mobile') 
                ->addSearchableAttribute('bc_email') 
                ->addSearchableAttribute('hs_development_compliance') 
                ->addSearchableAttribute('overall_budget') 
                ->addSearchableAttribute('actual_spend') 
                ->with('property');
            })
            ->registerModel(OperationUtility::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                ->addSearchableAttribute('gas_provider') 
                ->addSearchableAttribute('gas_contract_start_date') 
                ->addSearchableAttribute('gas_contract_end_date') 
                ->addSearchableAttribute('gas_account_number') 
                ->addSearchableAttribute('electric_provider') 
                ->addSearchableAttribute('electric_contract_start_date') 
                ->addSearchableAttribute('electric_contract_end_date') 
                ->addSearchableAttribute('electric_account_number') 
                ->addSearchableAttribute('water_provider') 
                ->addSearchableAttribute('water_account_number') 
                ->addSearchableAttribute('tv_licence') 
                ->addSearchableAttribute('tv_licence_contract_start_date') 
                ->addSearchableAttribute('tv_licence_contract_end_date') 
                ->addSearchableAttribute('broadband_provider') 
                ->addSearchableAttribute('broadband_account_number') 
                ->addSearchableAttribute('insurance_in_place') 
                ->addSearchableAttribute('insurance_provider') 
                ->addSearchableAttribute('insurance_annual_cost') 
                ->addSearchableAttribute('insurance_start_date') 
                ->addSearchableAttribute('insurance_end_date') 
                ->addSearchableAttribute('insurance_policy_no') 
                ->addSearchableAttribute('insurance_account_no') 
                ->addSearchableAttribute('insurance_value') 
                ->addSearchableAttribute('insurance_renewal_date') 
                ->addSearchableAttribute('bills_received') 
                ->addSearchableAttribute('exempt') 
                ->addSearchableAttribute('exemption_date') 
                ->addSearchableAttribute('council_account_no') 
                ->addSearchableAttribute('operation_log') 
                ->with('property');
            })
            ->registerModel(OperationExpenditure::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                ->addSearchableAttribute('expenditure_year') 
                ->addSearchableAttribute('hmo_license_fee') 
                ->addSearchableAttribute('hmo_license_period') 
                ->addSearchableAttribute('hmo_fee_per_year') 
                ->addSearchableAttribute('maintenance_property_year') 
                ->addSearchableAttribute('maintenance_bed_year') 
                ->addSearchableAttribute('gas_property_year') 
                ->addSearchableAttribute('gas_bed_year') 
                ->addSearchableAttribute('electric_property_year') 
                ->addSearchableAttribute('electric_bed_year') 
                ->addSearchableAttribute('water_property_year') 
                ->addSearchableAttribute('water_bed_year') 
                ->addSearchableAttribute('internet_property_year') 
                ->addSearchableAttribute('internet_bed_year') 
                ->addSearchableAttribute('tv_license_per_house') 
                ->addSearchableAttribute('property_insurance_annual_cost') 
                ->addSearchableAttribute('total_opex_budget') 
                ->with('property');
            })
            ->registerModel(OperationInsurance::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                ->addSearchableAttribute('budget_year') 
                ->addSearchableAttribute('hmo_license_fee') 
                ->addSearchableAttribute('hmo_license_period') 
                ->addSearchableAttribute('hmo_fee_per_year') 
                ->addSearchableAttribute('maintenance_property_year') 
                ->addSearchableAttribute('maintenance_bed_year') 
                ->addSearchableAttribute('gas_property_year') 
                ->addSearchableAttribute('gas_bed_year') 
                ->addSearchableAttribute('electric_property_year') 
                ->addSearchableAttribute('electric_bed_year') 
                ->addSearchableAttribute('water_property_year') 
                ->addSearchableAttribute('water_bed_year') 
                ->addSearchableAttribute('internet_property_year') 
                ->addSearchableAttribute('internet_bed_year') 
                ->addSearchableAttribute('tv_license_per_house') 
                ->addSearchableAttribute('property_insurance_annual_cost') 
                ->addSearchableAttribute('total_opex_budget') 
                ->with('property');
            })
            ->registerModel(Finance::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                ->addSearchableAttribute('cm_mortgage_status') 
                ->addSearchableAttribute('cm_provider') 
                ->addSearchableAttribute('cm_account_no') 
                ->addSearchableAttribute('cm_start_date') 
                ->addSearchableAttribute('cm_expiration_date') 
                ->addSearchableAttribute('cm_loan_period') 
                ->addSearchableAttribute('cm_current_valuation') 
                ->addSearchableAttribute('cm_loan_amount') 
                ->addSearchableAttribute('cm_loan') 
                ->addSearchableAttribute('cm_interest_rate') 
                ->addSearchableAttribute('cm_monthly_repayments') 
                ->addSearchableAttribute('cm_monthly_payment_date') 
                ->addSearchableAttribute('m_provider') 
                ->addSearchableAttribute('m_account_no') 
                ->addSearchableAttribute('m_start_date') 
                ->addSearchableAttribute('m_expiration_date') 
                ->addSearchableAttribute('m_loan_period') 
                ->addSearchableAttribute('m_estimated_loan') 
                ->addSearchableAttribute('m_agreed_loan') 
                ->addSearchableAttribute('m_estimated_equity_release') 
                ->addSearchableAttribute('m_equity_release') 
                ->addSearchableAttribute('m_loan') 
                ->addSearchableAttribute('m_start_fixed_rate_period') 
                ->addSearchableAttribute('m_end_fixed_rate_period') 
                ->addSearchableAttribute('m_monthly_repayment') 
                ->addSearchableAttribute('m_monthly_payment_date') 

                ->with('property');
            })
            ->registerModel(Letting::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                ->addSearchableAttribute('version') 
                ->addSearchableAttribute('property_contract_status') 
                ->addSearchableAttribute('target_weekly_rent') 
                ->addSearchableAttribute('achieved_weekly_rent') 
                ->addSearchableAttribute('floorplan') 
                ->addSearchableAttribute('date_of_refurb') 
                ->addSearchableAttribute('tv') 
                ->addSearchableAttribute('archive') 
                ->with('property');
            })
            ->search($query);


        return $searchResults;
    }
}
