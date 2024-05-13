<?php

namespace App\Models;
use App\Entity;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Development extends Model
{
    use HasFactory;

    protected $fillable = [
        'existing_beds',
        'existing_stories',
        'bric_stories',
        'bric_beds',
        'project_start_date',
        'projected_completion_date',
        'over_running',
        'development_status',
        'pc_company',
        'pc_name',
        'pc_mobile',
        'pc_email',
        'bc_company',
        'bc_name',
        'bc_mobile',
        'bc_email',
        'hs_development_compliance',
        'overall_budget',
        'actual_spend',
    ];
    public function getDevelopment($request){

        $developments = DB::table('properties')
        ->leftJoin('entity_properties', 'entity_properties.property_id', '=', 'properties.id')
        ->leftJoin('entities', 'entity_properties.entity_id', '=', 'entities.id')
        ->leftJoin('letting_statuses', 'properties.status', '=', 'letting_statuses.id')
        ->leftJoin('acquisitions', 'properties.id', '=', 'acquisitions.property_id')
        ->leftJoin('developments', 'properties.id', '=', 'developments.property_id')
        ->select(
            'properties.id',
            DB::raw("CASE property_phase WHEN 'Acquiring' THEN 1 WHEN 'In Development' THEN 2 WHEN 'Bric Property' THEN 3 END AS is_property_phase_order"),
            'properties.property_phase',
            'properties.city',
            'properties.area',
            DB::raw("CONCAT(properties.house_no_or_name,' ',properties.street) AS house_and_street"),
            'properties.postcode',
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
            'developments.project_start_date',
            'developments.projected_completion_date',
            'developments.over_running',
            'developments.development_status',
            'developments.overall_budget',
        )->where('properties.property_phase', '=', 'In Development');

        if ($request->property_phase) {
            $developments = $developments->where(function($pp) use ($request) {
                foreach ($request->property_phase as $ppKey => $ppVal) {
                    $pp->orWhere('properties.property_phase', '=', $ppVal);
                }
            });      
        }

        if ($request->entity) {
            $developments = $developments->where(function($e) use ($request) {
                foreach ($request->entity as $eKey => $eVal) {
                    $e->orWhere('entities.entity', '=', $eVal);
                }
            });      
        }
        
        if ($request->city) {
            $developments = $developments->where(function($c) use ($request) {
                foreach ($request->city as $cKey => $cVal) {
                    $c->orWhere('properties.city', '=', $cVal);
                }
            });      
        }
        if ($request->area) {
            $developments = $developments->where(function($a) use ($request) {
                foreach ($request->area as $aKey => $aVal) {
                    $a->orWhere('properties.area', '=', $aVal);
                }
            });      
        }
        if ($request->no_bric_beds) {
            $developments = $developments->where(function($nbb) use ($request) {
                foreach ($request->no_bric_beds as $nbbKey => $nbbVal) {
                    $nbb->orWhere('properties.no_bric_beds', '=', $nbbVal);
                }
            });      
        }
        if ($request->status) {
            $developments = $developments->where(function($s) use ($request) {
                foreach ($request->status as $sKey => $sVal) {
                    $s->orWhere('properties.status', '=', $sVal);
                }
            });      
        }
        if ($request->postcode) {
            $developments = $developments->where(function($pc) use ($request) {
                foreach ($request->postcode as $pcKey => $pcVal) {
                    $pc->orWhere('properties.postcode', '=', $pcVal);
                }
            });      
        }
        if ($request->address) {
            $developments = $developments->where(function($add) use ($request) {
                foreach ($request->address as $addKey => $addVal) {
                    $add->orWhere(DB::raw("CONCAT(house_no_or_name,' ',street)"), 'like', '%' . $addVal . '%');
                }
            });      
        }

        if ($request->search) {         
            $developments = $developments->where(function($q) use ($request) {
                $q->orWhere('properties.property_phase', 'like', '%' . $request->search . '%');
                $q->orWhere('properties.city', 'like', '%' . $request->search . '%');
                $q->orWhere('properties.area', 'like', '%' . $request->search . '%');
                $q->orWhere(DB::raw("CONCAT(house_no_or_name,' ',street)"), 'like', '%' . $request->search . '%');
                $q->orWhere('properties.postcode', 'like', '%' . $request->search . '%');
                $q->orWhere('properties.no_bric_beds', 'like', '%' . $request->search . '%');
                $q->orWhere('properties.no_bric_bathrooms', 'like', '%' . $request->search . '%');
                $q->orWhere('entities.entity', 'like', '%' . $request->search . '%');
            });
        }

        $developments = $developments->orderBy('is_property_phase_order', 'asc')->orderBy('properties.updated_at', 'desc')->get();

        return $developments;
    }

    public function editDevelopment($id){
        // $development = Development::findOrFail($id);
        $development = DB::table('developments')
                            ->leftJoin('properties', 'developments.property_id', '=', 'properties.id')
                            ->leftJoin('acquisitions', 'acquisitions.property_id', '=', 'developments.property_id')
                            ->selectRaw('acquisitions.existing_bedroom_no, properties.no_bric_beds ,developments.*')
                            ->where('developments.id', '=', $id)
                            ->first();
        return $development;
    }
    public function updateDevelopment($request, $id){
        try {
            $development = Development::where('developments.id', '=', $id)
            ->update([
                'developments.existing_stories' => $request->formData['existing_stories'],
                'developments.bric_stories' => $request->formData['bric_stories'],
                'developments.project_start_date' => $request->formData['project_start_date'],
                'developments.projected_completion_date' => $request->formData['projected_completion_date'],
                'developments.development_status' => $request->formData['development_status'],
                'developments.pc_company' => $request->formData['pc_company'],
                'developments.pc_name' => $request->formData['pc_name'],
                'developments.pc_mobile' => $request->formData['pc_mobile'],
                'developments.pc_email' => $request->formData['pc_email'],
                'developments.bc_company' => $request->formData['bc_company'],
                'developments.bc_name' => $request->formData['bc_name'],
                'developments.bc_mobile' => $request->formData['bc_mobile'],
                'developments.bc_email' => $request->formData['bc_email'],
                'developments.overall_budget' => $request->formData['overall_budget'],
                'developments.actual_spend' => $request->formData['actual_spend'],
            ]);

            $propertyID = Development::where('developments.id', '=', $id)
            ->selectRaw('developments.property_id')
            ->first();

            $propertiesUpdate = DB::table('properties')
            ->where('properties.id', '=', $propertyID->property_id)
            ->update([
                'properties.no_bric_beds' => $request->formData['bric_beds'],
            ]);

            $acquisitionData = DB::table('acquisitions')
            ->where('acquisitions.property_id', '=', $propertyID->property_id)
            ->first();

            $bricPurchaseYieldPercentage = null;
            if ($acquisitionData->bric_y1_proposed_rent_pppw != "" || $acquisitionData->bric_y1_proposed_rent_pppw != null && $acquisitionData->tenancy_length_weeks != '' || $acquisitionData->tenancy_length_weeks != null && $request->formData['bric_beds'] != '' || $request->formData['bric_beds'] != null) {
                $bricPurchaseYield = (intval($acquisitionData->bric_y1_proposed_rent_pppw) * intval($acquisitionData->tenancy_length_weeks) * intval($request->formData['bric_beds'])) / intval(str_replace(",", "", $acquisitionData->estimated_tpc));
                $bricPurchaseYieldPercentage = round($bricPurchaseYield * 100, '3');
            }
            $tpcBedspace = null;
            if ($acquisitionData->estimated_tpc != '' || $acquisitionData->estimated_tpc != null && $request->formData['bric_beds'] != '' || $request->formData['bric_beds'] != null) {
                $tpcBedspace = number_format(round(intval(str_replace(",", "", $acquisitionData->estimated_tpc)) / intval($request->formData['bric_beds'])));
            }
            $purchasePriceBedSpace = null;
            if ($acquisitionData->agreed_purchase_price != '' && $acquisitionData->agreed_purchase_price != null && $request->formData['existing_beds'] != '' || $request->formData['existing_beds'] != null) {
                $purchasePriceBedSpace = number_format(round(intval(str_replace(",", "", $acquisitionData->agreed_purchase_price)) / intval($request->formData['existing_beds'])));
            }

            $acquisitionUpdate = DB::table('acquisitions')
                            ->where('acquisitions.id', '=', $acquisitionData->id)
                            ->update([
                                'acquisitions.existing_bedroom_no' => $request->formData['existing_beds'],
                                'acquisitions.bric_purchase_yield_percentage' => $bricPurchaseYieldPercentage,
                                'acquisitions.tpc_bedspace' => $tpcBedspace,
                                'acquisitions.purchase_price_bedspace' => $purchasePriceBedSpace,
                                'acquisitions.updated_at' => $acquisitionData->updated_at,
                            ]);
            
            return $propertyID;
        }  catch (\Throwable $th) { 
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 200);
        }
    }

    public function updateHsDevelopment($request, $id){
        try {
            $development = Development::where('developments.id', '=', $id)
            ->update([
                'developments.hs_development_compliance' => json_encode($request->hs_development_compliance),
            ]);
            return $development;
        }  catch (\Throwable $th) { 
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 200);
        }
    }

    public function import($data, $entitiy){
        foreach ($data[0] as $pck => $pcVal) {
            $property = DB::table('properties')->where('ref_no', $pcVal[0])->select('properties.id', 'properties.no_bric_beds')->first();
            if ($property) {
                $developmentID = DB::table('developments')->where('property_id', $property->id)->select('id')->first();
                if ($developmentID->id) {
                    $hsCompliance = [];
                    if ($pcVal[14] === 'Yes') {
                        array_push($hsCompliance, 'Asbestos Survey');
                    }
                    if ($pcVal[15] === 'Yes') {
                        array_push($hsCompliance, 'RAMS');
                    }
                    if ($pcVal[16] === 'Yes') {
                        array_push($hsCompliance, 'COSHH');
                    }
                    if ($pcVal[17] === 'Yes') {
                        array_push($hsCompliance, 'Neighbours Notified');
                    }
                    
                    // Development
                    $development = DB::table('developments')
                    ->where('developments.id', '=', $developmentID->id)
                    ->update([
                        'developments.property_id' => $property->id,
                        'developments.existing_beds' => $property->no_bric_beds,
                        'developments.existing_stories' => $pcVal[1] ? strval($pcVal[1]) : null,
                        'developments.bric_stories' => $pcVal[2] ? strval($pcVal[2]) : null,
                        'developments.bric_beds' => $property->no_bric_beds,
                        'developments.project_start_date' => $pcVal[3] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pcVal[3])->format('d-m-Y') : null,
                        'developments.projected_completion_date' => $pcVal[4] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pcVal[4])->format('d-m-Y') : null,
                        'developments.development_status' => $pcVal[5] ? $pcVal[5] : null,
                        'developments.pc_company' => $pcVal[6] ? $pcVal[6] : null,
                        'developments.pc_name' => $pcVal[7] ? $pcVal[7] : null,
                        'developments.pc_mobile' => $pcVal[8] ? strval($pcVal[8]) : null,
                        'developments.pc_email' => $pcVal[9] ? $pcVal[9] : null,
                        'developments.bc_company' => $pcVal[10] ? $pcVal[10] : null,
                        'developments.bc_name' => $pcVal[11] ? $pcVal[11] : null,
                        'developments.bc_mobile' => $pcVal[12] ? strval($pcVal[12]) : null,
                        'developments.bc_email' => $pcVal[13] ? $pcVal[13] : null,
                        'developments.hs_development_compliance' => count($hsCompliance) > 0 ? json_encode($hsCompliance) : null,
                        'developments.overall_budget' => $pcVal[18] ? number_format($pcVal[18]) : null,
                        'developments.actual_spend' => $pcVal[19] ? number_format($pcVal[19]) : null
                    ]);
                }
            }
        }

        return true;
    }
}
