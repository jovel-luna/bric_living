<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Entity;
use App\Models\EntityProperties;
use App\Models\OperationUtility;
use App\Models\OperationBudget;
use App\Models\OperationExpenditure;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class OperationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $filters = [];

        /* This is to get the distinct values from the database and pass it to the view. */
        $filterPropertyPhase = DB::table('properties')->select('property_phase')->distinct()->get();
        $filterCity = DB::table('properties')->select('city')->distinct()->get();
        $filterArea = DB::table('properties')->select('area')->distinct()->get();
        $filterEntity = DB::table('entities')->select('entity')->distinct()->orderBy('entity', 'asc')->get();
        $filterLettingStatus = DB::table('letting_statuses')->get();
        $filters = [
            'property_phase' => $filterPropertyPhase,
            'city' => $filterCity,
            'area' => $filterArea,
            'entity' => $filterEntity,
            'letting_status' => $filterLettingStatus
        ];

        if ($request->ajax()) {

            /* This is the query that is being used to get the data from the database. */
            $properties = DB::table('properties')
            ->leftJoin('entity_properties', 'entity_properties.property_id', '=', 'properties.id')
            ->leftJoin('entities', 'entity_properties.entity_id', '=', 'entities.id')
            ->leftJoin('letting_statuses', 'properties.status', '=', 'letting_statuses.id')
            ->leftJoin('operation_utilities', 'properties.id', '=', 'operation_utilities.property_id')
            ->leftJoin('locations', 'properties.location_id', '=', 'locations.id')

            ->select(
                'properties.id',
                DB::raw("CASE property_phase WHEN 'Acquiring' THEN 1 WHEN 'In Development' THEN 2 WHEN 'Bric Property' THEN 3 WHEN 'External Property' THEN 4 END AS is_property_phase_order"),
                'properties.property_phase',
                'locations.city',
                'locations.area',
                DB::raw("CONCAT(properties.house_no_or_name,' ',properties.street) AS house_and_street"),
                'locations.postcode',
                'properties.no_bric_beds',
                'properties.no_bric_bathrooms',
                'operation_utilities.gas_provider',
                'operation_utilities.electric_provider',
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

            $properties = $properties->where(function($ex) use ($request) {
                $ex->orWhere('properties.purchase_date', '!=', '00/00/0000');
                $ex->orWhere('properties.property_phase', '!=', 'Acquiring');
            });

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
            /* This is the code that is being used to return the data to the datatable. */
            return Datatables::of($properties)
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('operation.index', compact('filters'));
    }

    public function createBudget($id)
    {
        $data = Property::selectRaw('properties.id, properties.no_bric_beds')
        ->where('properties.id', '=', $id)
        ->first();
        return view('operation.create-budget', compact('data'));
    }
    public function storeBudget(Request $request, $id)
    {
        if ($request->ajax()) {
            try {
                $opsBudget = new OperationBudget();
                $opsBudget->property_id = $id;
                $opsBudget->budget_year = $request->formData['budget_year'];
                $opsBudget->hmo_licence_fee = $request->formData['hmo_licence_fee'];
                $opsBudget->hmo_licence_period = $request->formData['hmo_licence_period'];
                $opsBudget->hmo_fee_per_year = $request->formData['hmo_fee_per_year'];
                $opsBudget->maintenance_property_year = $request->formData['maintenance_property_year'];
                $opsBudget->maintenance_bed_year = $request->formData['maintenance_bed_year'];
                $opsBudget->gas_property_year = $request->formData['gas_property_year'];
                $opsBudget->gas_bed_year = $request->formData['gas_bed_year'];
                $opsBudget->electric_property_year = $request->formData['electricity_property_year'];
                $opsBudget->electric_bed_year = $request->formData['electricity_bed_year'];
                $opsBudget->water_property_year = $request->formData['water_property_year'];
                $opsBudget->water_bed_year = $request->formData['water_bed_year'];
                $opsBudget->internet_property_year = $request->formData['internet_property_year'];
                $opsBudget->internet_bed_year = $request->formData['internet_bed_year'];
                $opsBudget->tv_licence_per_house = $request->formData['tv_licence_per_house'];
                $opsBudget->property_insurance_annual_cost = $request->formData['property_annual_cost'];
                $opsBudget->total_opex_budget = $request->formData['total_opex_budget'];
                $opsBudget->save();

                return [
                    "status" => 1,
                    "data" => 'Success',
                    "id" => $id,
                ];
            }  catch (\Throwable $th) { 
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 200);
            }
        }
    }
    public function storeExpenditure(Request $request, $id)
    {
        if ($request->ajax()) {
            try {
                $opsBudget = new OperationExpenditure();
                $opsBudget->property_id = $id;
                $opsBudget->expenditure_year = $request->formData['expenditure_year'];
                $opsBudget->hmo_licence_fee = $request->formData['hmo_licence_fee'];
                $opsBudget->hmo_licence_period = $request->formData['hmo_licence_period'];
                $opsBudget->hmo_fee_per_year = $request->formData['hmo_fee_per_year'];
                $opsBudget->maintenance_property_year = $request->formData['maintenance_property_year'];
                $opsBudget->maintenance_bed_year = $request->formData['maintenance_bed_year'];
                $opsBudget->gas_property_year = $request->formData['gas_property_year'];
                $opsBudget->gas_bed_year = $request->formData['gas_bed_year'];
                $opsBudget->electric_property_year = $request->formData['electricity_property_year'];
                $opsBudget->electric_bed_year = $request->formData['electricity_bed_year'];
                $opsBudget->water_property_year = $request->formData['water_property_year'];
                $opsBudget->water_bed_year = $request->formData['water_bed_year'];
                $opsBudget->internet_property_year = $request->formData['internet_property_year'];
                $opsBudget->internet_bed_year = $request->formData['internet_bed_year'];
                $opsBudget->tv_licence_per_house = $request->formData['tv_licence_per_house'];
                $opsBudget->property_insurance_annual_cost = $request->formData['property_annual_cost'];
                $opsBudget->total_opex_budget = $request->formData['total_opex_budget'];
                $opsBudget->save();

                return [
                    "status" => 1,
                    "data" => 'Success',
                    "id" => $id,
                ];
            }  catch (\Throwable $th) { 
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 200);
            }
        }
    }
    public function createExpenditure($id)
    {
        $data = Property::selectRaw('properties.id, properties.no_bric_beds')
        ->where('properties.id', '=', $id)
        ->first();
        return view('operation.create-expenditure', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $operation_utitlities = OperationUtility::findorfail($id);
        return view('operation.edit', [
            'data' => $operation_utitlities
        ]);
    }
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            try {
                DB::table('operation_utilities')
                ->where('operation_utilities.id', '=', $id)
                ->update([
                    'operation_utilities.gas_provider' => $request->formData['gas_provider'],
                    'operation_utilities.gas_contract_start_date' => $request->formData['gas_contract_start_date'],
                    'operation_utilities.gas_contract_end_date' => $request->formData['gas_contract_end_date'],
                    'operation_utilities.gas_account_number' => $request->formData['gas_account_number'],
                    'operation_utilities.electric_provider' => $request->formData['electric_provider'],
                    'operation_utilities.electric_contract_start_date' => $request->formData['electric_contract_start_date'],
                    'operation_utilities.electric_contract_end_date' => $request->formData['electric_contract_end_date'],
                    'operation_utilities.electric_account_number' => $request->formData['electric_account_number'],
                    'operation_utilities.water_provider' => $request->formData['water_provider'],
                    'operation_utilities.water_account_number' => $request->formData['water_account_number'],
                    'operation_utilities.tv_licence' => $request->formData['tv_licence'],
                    'operation_utilities.tv_licence_contract_start_date' => $request->formData['tv_licence_contract_start_date'],
                    'operation_utilities.tv_licence_contract_end_date' => $request->formData['tv_licence_contract_end_date'],
                    'operation_utilities.broadband_provider' => $request->formData['broadband_provider'],
                    'operation_utilities.broadband_account_number' => $request->formData['broadband_account_number'],
                    'operation_utilities.insurance_provider' => $request->formData['insurance_provider'],
                    // 'operation_utilities.insurance_annual_cost' => $request->formData['insurance_annual_cost'],
                    'operation_utilities.insurance_start_date' => $request->formData['insurance_start_date'],
                    'operation_utilities.insurance_end_date' => $request->formData['insurance_end_date'],
                    'operation_utilities.insurance_policy_no' => $request->formData['insurance_policy_no'],
                    // 'operation_utilities.bills_received' => $request->formData['bills_received'],
                    'operation_utilities.exempt' => $request->formData['exempt'],
                    'operation_utilities.exemption_date' => $request->formData['exemption_date'],
                    'operation_utilities.council_account_no' => $request->formData['council_account_no'],
                    // 'operation_utilities.operation_log' => $request->formData['operation_log'],
                ]);

                return [
                    "status" => 1,
                    "data" => 'Success',
                ];
            }  catch (\Throwable $th) { 
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 200);
            }
        }
    }
}
