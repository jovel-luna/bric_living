<?php

namespace App\Models;
use App\Models\Entity;
use App\Models\Acquisition;
use App\Models\Development;
use App\Models\OperationUtility;
use App\Models\Letting;
use App\Models\Location;
use App\Models\Finance;
use App\Models\EntityProperties;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_phase',
        'city',
        'area',
        'house_no_or_name',
        'street',
        'postcode',
        'no_bric_beds',
        'gas_provider',
        'no_bric_bathrooms',
        'purchase_date',
        'status',
    ];

    public function entities(){
        return $this->belongsToMany(Entity::class);
    }

    public function filter(){
        $filters = [];
        $filterPropertyPhase = DB::table('properties')->select('property_phase')->distinct()->get();
        // $filterCity = DB::table('properties')->select('city')->distinct()->get();
        // $filterArea = DB::table('properties')->select('area')->distinct()->get();
        $filterCity = DB::table('locations')->select('city')->distinct()->get();
        $filterArea = DB::table('locations')->select('area')->distinct()->get();
        $filterEntity = DB::table('entities')->select('entity')->distinct()->orderBy('entity', 'asc')->get();
        $filterLettingStatus = DB::table('letting_statuses')->get();

        $filters = [
            'property_phase' => $filterPropertyPhase,
            'city' => $filterCity,
            'area' => $filterArea,
            'entity' => $filterEntity,
            'letting_status' => $filterLettingStatus
        ];
        return $filters;
    }

    public function getProperty($request){

        $properties = DB::table('properties')
        ->leftJoin('entity_properties', 'entity_properties.property_id', '=', 'properties.id')
        ->leftJoin('entities', 'entity_properties.entity_id', '=', 'entities.id')
        ->leftJoin('letting_statuses', 'properties.status', '=', 'letting_statuses.id')
        ->leftJoin('locations', 'properties.location_id', '=', 'locations.id')
        ->select(
            'properties.id',
            'properties.ref_no',
            DB::raw("CASE property_phase WHEN 'Acquiring' THEN 1 WHEN 'In Development' THEN 2 WHEN 'Bric Property' THEN 3 WHEN 'External Property' THEN 4 END AS is_property_phase_order"),
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
            'letting_statuses.letting_status_name'
        );

        if ($request->property_phase) {
            $properties = $properties->where(function($pp) use ($request) {
                foreach ($request->property_phase as $ppKey => $ppVal) {
                    $pp->orWhere('properties.property_phase', '=', $ppVal);
                }
            });      
        }

        if ($request->entity) {
            $properties = $properties->where(function($e) use ($request) {
                foreach ($request->entity as $eKey => $eVal) {
                    $e->orWhere('entities.entity', '=', $eVal);
                }
            });      
        }
        
        if ($request->city) {
            $properties = $properties->where(function($c) use ($request) {
                foreach ($request->city as $cKey => $cVal) {
                    $c->orWhere('locations.city', '=', $cVal);
                }
            });      
        }
        if ($request->area) {
            $properties = $properties->where(function($a) use ($request) {
                foreach ($request->area as $aKey => $aVal) {
                    $a->orWhere('locations.area', '=', $aVal);
                }
            });      
        }
        if ($request->no_bric_beds) {
            $properties = $properties->where(function($nbb) use ($request) {
                foreach ($request->no_bric_beds as $nbbKey => $nbbVal) {
                    $nbb->orWhere('properties.no_bric_beds', '=', $nbbVal);
                }
            });      
        }
        if ($request->status) {
            $properties = $properties->where(function($s) use ($request) {
                foreach ($request->status as $sKey => $sVal) {
                    $s->orWhere('properties.status', '=', $sVal);
                }
            });      
        }
        if ($request->postcode) {
            $properties = $properties->where(function($pc) use ($request) {
                foreach ($request->postcode as $pcKey => $pcVal) {
                    $pc->orWhere('locations.postcode', '=', $pcVal);
                }
            });      
        }
        if ($request->address) {
            $properties = $properties->where(function($add) use ($request) {
                foreach ($request->address as $addKey => $addVal) {
                    $add->orWhere(DB::raw("CONCAT(house_no_or_name,' ',street)"), 'like', '%' . $addVal . '%');
                }
            });      
        }

        if ($request->search) {         
            $properties = $properties->where(function($q) use ($request) {
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

        $properties = $properties->orderBy('is_property_phase_order', 'asc')->orderBy('properties.updated_at', 'desc')->get();

        return $properties;
    }

    public function isExisting($request){
        $recordExist = Property::where('postcode', '=', $request->postcode)
        ->where('house_no_or_name', '=', $request->house_no)->exists();
        return $recordExist;
    }

    public function import($data, $entitiy){

        foreach ($data[0] as $pck => $pcVal) {
            foreach ($entitiy as $ek => $eVal) {
                if (in_array($pcVal[1], $eVal)) {

                    if ($pcVal[0] === 'In Development') {
                        $status = '4';
                    }else{
                        switch ($pcVal[9]) {
                            case 'Tenanted':
                                $status = '1';
                                break;
                            
                            case 'Under Offer':
                                $status = '2';
                                break;
                            
                            case 'Available':
                                $status = '3';
                                break;
                            
                            case 'Available Soon':
                                $status = '4';
                                break;
                        }
                    }
                    if ($pcVal[10] === '00/00/0000') {
                        $pcVal[10] = '00/00/0000';
                    }else{
                        // $stringWithSpaces = '09/05/2023     ';
                        // $stringWithoutSpaces = str_replace(' ', '', $stringWithSpaces);
                        // $dateObject = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($stringWithoutSpaces);
                        // $formattedDate = $dateObject->format('d-m-Y');
                        // $pcVal[10] = $formattedDate;
                        $stringWithSpaces = $pcVal[10];

                        // Remove spaces using str_replace
                        $stringWithoutSpaces = str_replace(' ', '', $stringWithSpaces);

                        // Parse the date using createFromFormat
                        $dateObject = DateTime::createFromFormat('d/m/Y', $stringWithoutSpaces);

                        // Check if the date was parsed successfully
                        if ($dateObject !== false) {
                            // Format the date as 'd-m-Y'
                            $formattedDate = $dateObject->format('d-m-Y');
                            $pcVal[10] = $formattedDate;
                        }
                    }

                    if ($pcVal[0] != 'External Property') {
                        $pdata = Property::select('ref_no')->where('type', 'Internal')->orderBy('id', 'desc')->first();
                        if ($pdata) {
                            $nextRefNo = $pdata->ref_no +1; 
                        }else{
                            $nextRefNo = '1000';
                        }

                        // Property
                        $properties = new Property();
                        $properties->ref_no = $nextRefNo;
                        $properties->type = 'Internal';
                        $properties->property_phase = $pcVal[0];
                        // $properties->city = $pcVal[2];
                        // $properties->area = $pcVal[3] ? $pcVal[3] : null;
                        $properties->house_no_or_name = strval($pcVal[4]);
                        $properties->street = $pcVal[5];
                        // $properties->postcode = $pcVal[6];

                        $location = Location::create([
                            'postcode' => $pcVal[6],
                            'city' => $pcVal[2],
                            'area' => $pcVal[3] ? $pcVal[3] : null
                        ]);

                        $properties->location_id = $location->id;

                        $properties->no_bric_beds = strval($pcVal[7]);
                        $properties->no_bric_bathrooms = strval($pcVal[8]);
                        $properties->status = $status;
                        $properties->purchase_date = $pcVal[10];
                        $properties->save();
                        $propertyID = $properties->id;

    
                        // Acquisition
                        $acquisition = new Acquisition();
                        $acquisition->property_id = $propertyID; 
                        $acquisition->acquisition_status = $pcVal[11] ? $pcVal[11] : null; //
                        $acquisition->single_asset_portfolio = $pcVal[12] ? $pcVal[12] : null; //
                        $acquisition->portfolio = $pcVal[13] ? $pcVal[13] : null;
                        $acquisition->existing_bedroom_no = $pcVal[14] ? strval($pcVal[14]) : null; //
                        $acquisition->stamp_duty = $pcVal[15] ? number_format($pcVal[15]) : null;
                        $acquisition->agent = $pcVal[16] ? $pcVal[16] : null; //
                        $acquisition->agent_fee_percentage = $pcVal[17] ? strval($pcVal[17]) : null;
                        $acquisition->agent_fee = $pcVal[18] ? number_format($pcVal[18]) : null;
                        $acquisition->estimated_tpc = $pcVal[19] ? number_format($pcVal[19]) : null;
                        $acquisition->offer_date = $pcVal[20] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pcVal[20])->format('d-m-Y') : null;
                        $acquisition->target_completion_date = $pcVal[21] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pcVal[21])->format('d-m-Y') : null;
                        if ($pcVal[10] == '00/00/0000') {
                            $comp_date = null;
                        }else{
                            $comp_date = $pcVal[10];
                        }
                        $acquisition->completion_date = $comp_date;
                        $acquisition->col_status = $pcVal[23] ? $pcVal[23] : null;
                        $acquisition->financing_status = $pcVal[24] ? $pcVal[24] : null;
                        $acquisition->asking_price = $pcVal[25] ? number_format($pcVal[25]) : null; //
                        $acquisition->offer_price = $pcVal[26] ? number_format($pcVal[26]) : null;
                        $acquisition->agreed_purchase_price = $pcVal[27] ? number_format($pcVal[27]) : null;
                        $acquisition->difference = $pcVal[29] ? number_format($pcVal[28]) : null;
                        $acquisition->acquisition_cost = $pcVal[29] ? number_format($pcVal[29]) : null;
                        $acquisition->bridge_loan = $pcVal[30] ? strval($pcVal[30]) : null;
                        $acquisition->estimated_period = $pcVal[31] ? strval($pcVal[31]) : null;
                        $acquisition->loan_percentage = $pcVal[32] ? strval($pcVal[32]) : null;
                        $acquisition->estimated_interest = $pcVal[33] ? number_format($pcVal[33]) : null;
                        $acquisition->capex_budget = $pcVal[34] ? number_format($pcVal[34]) : null;
                        $acquisition->bric_purchase_yield_percentage = $pcVal[35] ? strval($pcVal[35]) : null;
                        $acquisition->tpc_bedspace = $pcVal[36] ? number_format($pcVal[36]) : null;
                        $acquisition->purchase_price_bedspace = $pcVal[37] ? number_format($pcVal[37]): null;
                        $acquisition->bric_y1_proposed_rent_pppw = $pcVal[38] ? strval($pcVal[38]) : null;
                        $acquisition->tenancy_length_weeks = $pcVal[39] ? strval($pcVal[39]) : null;
                        $acquisition->tennure = $pcVal[40] ? $pcVal[40] : null; //
                        $acquisition->ground_rent = $pcVal[41] === "N/A" || $pcVal[41] == null ? null : number_format($pcVal[41]);
                        $acquisition->ground_rent_due = $pcVal[42] === 'N/A' || $pcVal[42] == null ? null : \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pcVal[42])->format('d-m-Y');
                        $acquisition->save();
    
                        // Development
                        $development = new Development();
                        $development->property_id = $propertyID;
                        $development->project_start_date = $pcVal[43] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pcVal[43])->format('d-m-Y') : null;
                        $development->projected_completion_date = $pcVal[44] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pcVal[44])->format('d-m-Y') : null;
                        if ($pcVal[0] == 'Acquiring') {
                            $dev_stat = null;
                        }else if($pcVal[0] == 'In Development'){
                            $dev_stat = 'On Site';
                        }else if($pcVal[0] == 'Inherited Tenant'){
                            $dev_stat = 'Pre-start (occupied)';
                        }else{
                            $dev_stat = 'Completed';
                        }
                        $development->development_status = $dev_stat;
                        $development->save();
                        // Operations
                        $operations_utilities = new OperationUtility();
                        $operations_utilities->property_id = $propertyID;
                        if ($pcVal[46] || $pcVal[47] || $pcVal[48]) {
                            $operations_utilities->insurance_in_place = 1;
                        }else{
                            $operations_utilities->insurance_in_place = 0;
                        }
                        $operations_utilities->insurance_value = $pcVal[46] ? number_format($pcVal[46]) : null;
                        $operations_utilities->insurance_annual_cost = $pcVal[47] ? number_format($pcVal[47]) : null;
                        $operations_utilities->insurance_renewal_date = $pcVal[48] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pcVal[48])->format('d-m-Y') : null;
                        $operations_utilities->exempt = 0;
                        $operations_utilities->save();
                        // Lettings
                        $lettings = new Letting();
                        $lettings->property_id = $propertyID;
                        $lettings->tv = 0;
                        $lettings->archive = 0;
                        $lettings->save();
                        // Finance
                        $finance = new Finance();
                        $finance->property_id = $propertyID;
                        $finance->save();
    
                        $ep = new EntityProperties();
                        $ep->entity_id = $eVal['id'];
                        $ep->property_id = $propertyID;
                        $ep->save();
                    }else{
                        $pdata = Property::select('ref_no')->where('type', 'External')->orderBy('id', 'desc')->first();
                        if ($pdata) {
                            $refNo = str_replace("E","",$pdata->ref_no);
                            $refNoFormat = $refNo + 1;
                            $nextRefNo = "E".$refNoFormat; 
                        }else{
                            $nextRefNo = 'E1000';
                        }
                        // Property
                        $properties = new Property();
                        $properties->ref_no = $nextRefNo;
                        $properties->type = 'External';
                        $properties->property_phase = $pcVal[0];
                        $properties->city = $pcVal[2]; 
                        $properties->area = $pcVal[3] ? $pcVal[3] : null;
                        $properties->house_no_or_name = strval($pcVal[4]);
                        $properties->street = $pcVal[5];
                        $properties->postcode = $pcVal[6];
                        $properties->no_bric_beds = strval($pcVal[7]);
                        $properties->no_bric_bathrooms = strval($pcVal[8]);
                        $properties->status = $status;
                        $properties->purchase_date = $pcVal[10];
                        $properties->save();
                        $propertyID = $properties->id;

                        $ep = new EntityProperties();
                        $ep->entity_id = $eVal['id'];
                        $ep->property_id = $propertyID;
                        $ep->save();

                        // Operations
                        $operations_utilities = new OperationUtility();
                        $operations_utilities->property_id = $propertyID;
                        $operations_utilities->save();
                        // Lettings
                        $lettings = new Letting();
                        $lettings->property_id = $propertyID;
                        $lettings->tv = 0;
                        $lettings->archive = 0;
                        $lettings->save();
                    }
                    break;
                }
            }
        }

        return true;
    }
}
