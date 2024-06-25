<?php

namespace App\Models;

use App\Entity;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Finance extends Model implements Searchable
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'cm_mortgage_status',
        'cm_provider',
        'cm_account_no',
        'cm_start_date',
        'cm_expiration_date',
        'cm_loan_period',
        'cm_current_valuation',
        'cm_loan_amount',
        'cm_loan',
        'cm_interest_rate',
        'cm_monthly_repayments',
        'cm_monthly_payment_date',
        'm_provider',
        'm_account_no',
        'm_start_date',
        'm_expiration_date',
        'm_loan_period',
        'm_estimated_loan',
        'm_agreed_loan',
        'm_estimated_equity_release',
        'm_equity_release',
        'm_loan',
        'm_start_fixed_rate_period',
        'm_end_fixed_rate_period',
        'm_monthly_repayment',
        'm_monthly_payment_date'
    ];
    protected static $logName = 'Finance';
    protected static $logFillable = true;

    public function getSearchResult(): SearchResult
    {
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->cm_mortgage_status,
            $this->cm_provider,
            $this->cm_account_no,
            $this->cm_start_date,
            $this->cm_expiration_date,
            $this->cm_loan_period,
            $this->cm_current_valuation,
            $this->cm_loan_amount,
            $this->cm_loan,
            $this->cm_interest_rate,
            $this->cm_monthly_repayments,
            $this->cm_monthly_payment_date,
            $this->m_provider,
            $this->m_account_no,
            $this->m_start_date,
            $this->m_expiration_date,
            $this->m_loan_period,
            $this->m_estimated_loan,
            $this->m_agreed_loan,
            $this->m_estimated_equity_release,
            $this->m_equity_release,
            $this->m_loan,
            $this->m_start_fixed_rate_period,
            $this->m_end_fixed_rate_period,
            $this->m_monthly_repayment,
            $this->m_monthly_payment_date
        );
    }

    public function property(){
        return $this->belongsTo(Property::class);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Finance has been {$eventName} ";
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName == 'updated'){
            $activity->location = "Finance Edit Page";
        }
        if($eventName == 'created'){ 
            $activity->location = "Create Finance Page";
        }
        if($eventName == 'deleted') {
            $activity->location = "Finance Edit Page";
        }

    }

    public function getFinance($request){

        $finances = DB::table('properties')
        ->leftJoin('entity_properties', 'entity_properties.property_id', '=', 'properties.id')
        ->leftJoin('entities', 'entity_properties.entity_id', '=', 'entities.id')
        ->leftJoin('letting_statuses', 'properties.status', '=', 'letting_statuses.id')
        ->leftJoin('acquisitions', 'properties.id', '=', 'acquisitions.property_id')
        ->leftJoin('developments', 'properties.id', '=', 'developments.property_id')
        ->leftJoin('finances', 'properties.id', '=', 'finances.property_id')
        ->leftJoin('locations', 'properties.location_id', '=', 'locations.id')
        ->select(
            'properties.id',
            DB::raw("CASE property_phase WHEN 'Acquiring' THEN 1 WHEN 'In Development' THEN 2 WHEN 'Bric Property' THEN 3 END AS is_property_phase_order"),
            'properties.property_phase',
            'locations.city',
            'locations.area',
            DB::raw("CONCAT(properties.house_no_or_name,' ',properties.street) AS house_and_street"),
            'locations.postcode',
            'properties.no_bric_beds',
            'properties.no_bric_bathrooms',
            'properties.purchase_date',
            'properties.status',
            'properties.updated_at',
            'entity_properties.id AS epID',
            'entity_properties.property_id',
            'entity_properties.entity_id',
            'entities.id AS eID',
            'entities.entity',
            'letting_statuses.letting_status_name',
            'acquisitions.existing_bedroom_no',
            'acquisitions.completion_date',
            'developments.project_start_date',
            'developments.projected_completion_date',
            'developments.over_running',
            'developments.development_status',
            'developments.overall_budget',
            'finances.finance_type',
            'finances.cm_provider',
            'finances.m_provider',
            'finances.cm_account_no',
            'finances.m_account_no',
        )->where('properties.property_phase', '=', 'Bric Property');

        if ($request->property_phase) {
            $finances = $finances->where(function($pp) use ($request) {
                foreach ($request->property_phase as $ppKey => $ppVal) {
                    $pp->orWhere('properties.property_phase', '=', $ppVal);
                }
            });      
        }

        if ($request->entity) {
            $finances = $finances->where(function($e) use ($request) {
                foreach ($request->entity as $eKey => $eVal) {
                    $e->orWhere('entities.entity', '=', $eVal);
                }
            });      
        }
        
        if ($request->city) {
            $finances = $finances->where(function($c) use ($request) {
                foreach ($request->city as $cKey => $cVal) {
                    $c->orWhere('locations.city', '=', $cVal);
                }
            });      
        }
        if ($request->area) {
            $finances = $finances->where(function($a) use ($request) {
                foreach ($request->area as $aKey => $aVal) {
                    $a->orWhere('locations.area', '=', $aVal);
                }
            });      
        }
        if ($request->no_bric_beds) {
            $finances = $finances->where(function($nbb) use ($request) {
                foreach ($request->no_bric_beds as $nbbKey => $nbbVal) {
                    $nbb->orWhere('properties.no_bric_beds', '=', $nbbVal);
                }
            });      
        }
        if ($request->status) {
            $finances = $finances->where(function($s) use ($request) {
                foreach ($request->status as $sKey => $sVal) {
                    $s->orWhere('properties.status', '=', $sVal);
                }
            });      
        }
        if ($request->postcode) {
            $finances = $finances->where(function($pc) use ($request) {
                foreach ($request->postcode as $pcKey => $pcVal) {
                    $pc->orWhere('locations.postcode', '=', $pcVal);
                }
            });      
        }
        if ($request->address) {
            $finances = $finances->where(function($add) use ($request) {
                foreach ($request->address as $addKey => $addVal) {
                    $add->orWhere(DB::raw("CONCAT(house_no_or_name,' ',street)"), 'like', '%' . $addVal . '%');
                }
            });      
        }

        if ($request->search) {         
            $finances = $finances->where(function($q) use ($request) {
                $q->orWhere('properties.property_phase', 'like', '%' . $request->search . '%');
                $q->orWhere('locations.city', 'like', '%' . $request->search . '%');
                $q->orWhere('locations.area', 'like', '%' . $request->search . '%');
                $q->orWhere(DB::raw("CONCAT(house_no_or_name,' ',street)"), 'like', '%' . $request->search . '%');
                $q->orWhere('locations.postcode', 'like', '%' . $request->search . '%');
                $q->orWhere('properties.no_bric_beds', 'like', '%' . $request->search . '%');
                $q->orWhere('properties.no_bric_bathrooms', 'like', '%' . $request->search . '%');
                $q->orWhere('entities.entity', 'like', '%' . $request->search . '%');
            });
        }

        $finances = $finances->orderBy('is_property_phase_order', 'asc')->orderBy('properties.updated_at', 'desc')->get();
        return $finances;
    }

    public function getFinanceById($id){
        $finance = Finance::where('finances.id', '=', $id)->first();
        return $finance;
    }

    public function addFinanceData($id){
        $finances = new Finance();
        $finances->property_id = $id;
        $finances->save();
        $id = $finances->id;
        return $id;
    }
    public function import($data, $entitiy){
        foreach ($data[0] as $pck => $pcVal) {            
            $propertyID = DB::table('properties')->where('ref_no', $pcVal[0])->select('properties.id')->first();
            if ($propertyID) {
                $financeID = DB::table('finances')->where('property_id', $propertyID->id)->select('id')->first();
                // update Finance
                if ($financeID) {
                    $finances = DB::table('finances')
                    ->where('finances.id', '=', $financeID->id)
                    ->update([
                        'finances.property_id' => $propertyID->id,
                        'finances.cm_mortgage_status' => $pcVal[1] ? $pcVal[1] : null,
                        'finances.cm_provider' => $pcVal[2] ? $pcVal[2] : null,
                        'finances.cm_account_no' => $pcVal[3] ? intval($pcVal[3]) : null,
                        'finances.cm_start_date' => $pcVal[4] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pcVal[4])->format('d-m-Y') : null,
                        'finances.cm_expiration_date' => $pcVal[5] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pcVal[5])->format('d-m-Y') : null,
                        'finances.cm_loan_period' => $pcVal[6] ? intval($pcVal[6]) : null,
                        'finances.cm_current_valuation' => $pcVal[7] ? number_format($pcVal[7]) : null,
                        'finances.cm_loan_amount' => $pcVal[8] ? number_format($pcVal[8]) : null,
                        'finances.cm_loan' => $pcVal[9] ? number_format($pcVal[9]) : null,
                        'finances.cm_interest_rate' => $pcVal[10] ? $pcVal[10] : null,
                        'finances.cm_monthly_repayments' => $pcVal[11] ? number_format($pcVal[11]) : null,
                        'finances.cm_monthly_payment_date' => $pcVal[12] ? intval($pcVal[12]) : null,
                        'finances.m_provider' => $pcVal[13] ? $pcVal[13] : null,
                        'finances.m_account_no' => $pcVal[14] ? strval($pcVal[14]) : null,
                        'finances.m_start_date' => $pcVal[15] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pcVal[15])->format('d-m-Y') : null,
                        'finances.m_expiration_date' => $pcVal[16] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pcVal[16])->format('d-m-Y') : null,
                        'finances.m_estimated_loan' => $pcVal[17] ? number_format($pcVal[17]) : null,
                        'finances.m_agreed_loan' => $pcVal[18] ? number_format($pcVal[18]) : null,
                        'finances.m_estimated_equity_release' => $pcVal[19] ? number_format($pcVal[19]) : null,
                        'finances.m_equity_release' => $pcVal[20] ? number_format($pcVal[20]) : null,
                        'finances.m_loan' => $pcVal[21] ? number_format($pcVal[21]) : null,
                        'finances.m_end_fixed_rate_period' => $pcVal[22] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pcVal[22])->format('d-m-Y') : null,
                        'finances.m_monthly_repayment' => $pcVal[23] ? number_format($pcVal[23]) : null,
                        'finances.m_monthly_payment_date' => $pcVal[24] ? intval($pcVal[24]) : null,
                    ]);
                }
            }
        }

        return true;
    }
}
