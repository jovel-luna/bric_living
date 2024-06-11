<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Property;
use App\Models\Entity;
use App\Models\EntityProperties;
use App\Models\Acquisition;
use App\Models\OperationUtility;
use App\Models\OperationInsurance;
use App\Models\LettingStatus;
use App\Models\Planning;
use App\Models\Location;
use App\Models\Development;
use App\Models\ActivityLog;
use App\Models\Log as LogModel;
use Illuminate\Support\Facades\Log as LogFacade;
use DataTables;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Auth;

use Spatie\Activitylog\Contracts\Activity;

use Illuminate\Support\Facades\Validator;

class AcquisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $entity = Entity::getEntities();
        $property_status = $letting_statuses = LettingStatus::all();

        $acquisition_status = [
            'Watching' => 'Watching',
            'Analysing' => 'Analysing',
            'Offer Made' => 'Offer Made',
            'Offer Rejected' => 'Offer Rejected',
            'Offer Accepted' => 'Offer Accepted',
            'Exchanged' => 'Exchanged',
            'Completed' => 'Completed'
        ];
        $single_asset_portfolio = [
            'Single Asset' => 'Single Asset',
            'Portfolio' => 'Portfolio',
            'Block' => 'Block'
        ];
        $col_status = [
            'No evidence received' => 'No evidence received',
            'Evidence requested' => 'Evidence requested',
            'Partial evidence received' => 'Partial evidence received',
            'All evidence received' => 'All evidence received',
            'COL submitted' => 'COL submitted',
            'COL granted' => 'COL granted'
        ];
        $financing_status = [
            'Cash' => 'Cash',
            'Bridge Loan' => 'Bridge Loan'
        ];
        $tennure = [
            'Freehold' => 'Freehold',
            'Leasehold' => 'Leasehold'
        ];

        $data = [
            'entity' => $entity,
            'property_status' => $property_status,
            'acquisition_status' => $acquisition_status,
            'single_asset_portfolio' => $single_asset_portfolio,
            'col_status' => $col_status,
            'financing_status' => $financing_status,
            'tennure' => $tennure,
        ];

        $filters = [];

        /* This is to get the distinct values from the database and pass it to the view. */
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

        if ($request->ajax()) {

            /* This is the query that is being used to get the data from the database. */
            $acquisitions = Acquisition::leftJoin('properties', 'acquisitions.property_id', '=', 'properties.id')
                ->leftJoin('entity_properties', 'entity_properties.property_id', '=', 'properties.id')
                ->leftJoin('entities', 'entity_properties.entity_id', '=', 'entities.id')
                ->leftJoin('locations', 'properties.location_id', '=', 'locations.id')
                // ->leftJoin('logs', 'logs.property_id', '=', 'acquisitions.property_id')
                ->select(
                    'acquisitions.id as id',
                    'entities.entity',
                    DB::raw("CONCAT(properties.house_no_or_name,' ',properties.street) AS address"),
                    'properties.id as property_id',
                    'properties.house_no_or_name',
                    'properties.property_phase',
                    'properties.street',
                    'locations.area',
                    'locations.city',
                    'locations.postcode',
                    'properties.status',
                    'properties.no_bric_beds',
                    'properties.no_bric_bathrooms',
                    'entity_properties.id as entity_property_id',
                    'acquisitions.acquisition_status',
                    'acquisitions.asking_price',
                    'acquisitions.agreed_purchase_price',
                    'acquisitions.agent',
                    'acquisitions.portfolio',
                    'acquisitions.target_completion_date',
                    'acquisitions.col_status',
                    'acquisitions.col_status_log',
                    'acquisitions.created_at',
                    DB::raw('(SELECT description from logs WHERE property_id = properties.id order by created_at desc LIMIT 1) as last_col_log')

                )
                ->where('acquisitions.acquisition_status', '!=', 'Completed')
                ->where('properties.property_phase', '=', 'Acquiring');

            if ($request->property_phase) {
                $acquisitions = $acquisitions->where(function ($pp) use ($request) {
                    foreach ($request->property_phase as $ppKey => $ppVal) {
                        $pp->orWhere('properties.property_phase', '=', $ppVal);
                    }
                });
            }

            if ($request->entity) {
                $acquisitions = $acquisitions->where(function ($e) use ($request) {
                    foreach ($request->entity as $eKey => $eVal) {
                        $e->orWhere('entities.entity', '=', $eVal);
                    }
                });
            }

            if ($request->city) {
                $acquisitions = $acquisitions->where(function ($c) use ($request) {
                    foreach ($request->city as $cKey => $cVal) {
                        $c->orWhere('locations.city', '=', $cVal);
                    }
                });
            }
            if ($request->area) {
                $acquisitions = $acquisitions->where(function ($a) use ($request) {
                    foreach ($request->area as $aKey => $aVal) {
                        $a->orWhere('locations.area', '=', $aVal);
                    }
                });
            }
            if ($request->no_bric_beds) {
                $acquisitions = $acquisitions->where(function ($nbb) use ($request) {
                    foreach ($request->no_bric_beds as $nbbKey => $nbbVal) {
                        $nbb->orWhere('properties.no_bric_beds', '=', $nbbVal);
                    }
                });
            }
            if ($request->status) {
                $acquisitions = $acquisitions->where(function ($s) use ($request) {
                    foreach ($request->status as $sKey => $sVal) {
                        $s->orWhere('properties.status', '=', $sVal);
                    }
                });
            }
            if ($request->postcode) {
                $acquisitions = $acquisitions->where(function ($pc) use ($request) {
                    foreach ($request->postcode as $pcKey => $pcVal) {
                        $pc->orWhere('locations.postcode', '=', $pcVal);
                    }
                });
            }
            if ($request->address) {
                $acquisitions = $acquisitions->where(function ($add) use ($request) {
                    foreach ($request->address as $addKey => $addVal) {
                        $add->orWhere(DB::raw("CONCAT(properties.house_no_or_name,' ',properties.street)"), 'like', '%' . $addVal . '%');
                    }
                });
            }

            if ($request->search) {
                $acquisitions = $acquisitions->where(function ($q) use ($request) {
                    $q->orWhere('properties.property_phase', 'like', '%' . $request->search . '%');
                    $q->orWhere('locations.city', 'like', '%' . $request->search . '%');
                    $q->orWhere('locations.area', 'like', '%' . $request->search . '%');
                    $q->orWhere(DB::raw("CONCAT(properties.house_no_or_name,' ',properties.street)"), 'like', '%' . $request->search . '%');
                    $q->orWhere('locations.postcode', 'like', '%' . $request->search . '%');
                    $q->orWhere('properties.no_bric_beds', 'like', '%' . $request->search . '%');
                    $q->orWhere('properties.no_bric_bathrooms', 'like', '%' . $request->search . '%');
                    $q->orWhere('entities.entity', 'like', '%' . $request->search . '%');
                    $q->orWhere('acquisitions.acquisition_status', 'like', '%' . $request->search . '%');
                    $q->orWhere('acquisitions.agent', 'like', '%' . $request->search . '%');
                    $q->orWhere('acquisitions.col_status', 'like', '%' . $request->search . '%');
                });
            }
            $acquisitions = $acquisitions->get();
            // $logs  = LogModel::where('property_id' , $acquisitions->property_id)->orderBy('created_at')->get();


            /* This is the code that is being used to return the data to the datatable. */
            return Datatables::of($acquisitions)
                ->addIndexColumn()
                ->setRowAttr([
                    'data-id' => function ($acquisitions) {
                        return $acquisitions->id;
                    },
                    'data-entity-property' => function ($acquisitions) {
                        return $acquisitions->entity_property_id;
                    },
                    'data-property' => function ($acquisitions) {
                        return $acquisitions->property_id;
                    },
                    'data-current' => function ($acquisitions) {

                        $data = [
                            'id' => $acquisitions->id,
                            'house_no_or_name' => $acquisitions->house_no_or_name,
                            'street' => $acquisitions->street,
                            'city' => $acquisitions->city,
                            'area' => $acquisitions->area,
                            'postcode' => $acquisitions->postcode,
                            'no_bric_beds' => $acquisitions->no_bric_beds,
                            'status' => $acquisitions->status,
                            'entity' => $acquisitions->entity,
                            'agreed_purchase_price' => $acquisitions->agreed_purchase_price,
                            'agent' => $acquisitions->agent,
                            'target_completion_date' => $acquisitions->target_completion_date,
                            'col_status' => $acquisitions->col_status,
                            // 'last_col_log' => $log_description,

                        ];
                        return json_encode($data);
                    },
                ])
                ->make(true);
        }
        return view('acquisition.index', compact('data', 'filters'));
    }

    public function getAcquisitionById(Request $request)
    {
        if ($request->ajax()) {
            $acquisition = Acquisition::leftJoin('properties', 'acquisitions.property_id', '=', 'properties.id')
                ->leftJoin('locations', 'locations.id', '=', 'properties.location_id')
                ->leftJoin('entity_properties', 'entity_properties.property_id', '=', 'properties.id')
                ->leftJoin('entities', 'entity_properties.entity_id', '=', 'entities.id')
                ->selectRaw('entities.*, entity_properties.*, properties.*, acquisitions.*, locations.*')
                ->where('acquisitions.id', '=', $request->id)
                ->first();
            return response()->json([
                'data' => $acquisition,
            ]);
        }
    }
    public function getLastCOLLog(Request $request)
    {
        if ($request->ajax()) {
            $acquisition = Acquisition::leftJoin('properties', 'acquisitions.property_id', '=', 'properties.id')
                ->leftJoin('logs', 'logs.property_id', '=', 'properties.id')
                ->selectRaw('logs.*')
                ->where('acquisitions.id', '=', $request->id)
                ->first();
            return response()->json([
                'last_col_log' => $acquisition->description,
                'log_id' => $acquisition->id
            ]);
        }
    }

    public function getPlanning(Request $request, $id)
    {
        if ($request->ajax()) {
            $plannings = Planning::getPlanning($id);
            /* This is the code that is being used to return the data to the datatable. */
            return Datatables::of($plannings)
                ->addIndexColumn()
                ->make(true);
        }
    }
    public function getSpecificPlanning(Request $request, $id)
    {
        if ($request->ajax()) {
            $planning = Planning::getSinglePlanning($id);

            return response()->json([
                'data' => $planning,
            ]);
        }
    }

    public function savePlanning(Request $request, $id)
    {
        if ($request->ajax()) {
            try {
                $plannings = new Planning();
                $plannings->property_id = $id;
                $plannings->bric_planning_ref_no = $request['formData']['bric_planning_ref_no'];
                $plannings->date_submitted = $request['formData']['date_submitted'];
                $plannings->approved = $request['formData']['approved'];
                $plannings->application_desc = $request['formData']['application_desc'];
                $plannings->save();

                return [
                    "status" => 1,
                    "data" => 'Success',
                ];
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 200);
            }
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acquisition = Acquisition::leftJoin('properties', 'acquisitions.property_id', '=', 'properties.id')
            ->leftJoin('operation_insurances', 'operation_insurances.acquisition_id', '=', 'acquisitions.id')
            ->leftJoin('entity_properties', 'entity_properties.property_id', '=', 'properties.id')
            ->leftJoin('locations', 'properties.location_Id', '=', 'locations.id')
            ->leftJoin('entities', 'entity_properties.entity_id', '=', 'entities.id')
            ->join('letting_statuses', 'properties.status', '=', 'letting_statuses.id')
            ->selectRaw('letting_statuses.*, entities.*, entity_properties.*, operation_insurances.*, properties.*, locations.*, acquisitions.*')
            ->where('acquisitions.id', '=', $id)
            ->where('acquisitions.property_id', '=', 'properties.id')
            ->first();

        $acquisitionSQL = Acquisition::leftJoin('properties', 'acquisitions.property_id', '=', 'properties.id')
            ->leftJoin('operation_insurances', 'operation_insurances.acquisition_id', '=', 'acquisitions.id')
            ->leftJoin('entity_properties', 'entity_properties.property_id', '=', 'properties.id')
            ->leftJoin('locations', 'properties.location_Id', '=', 'locations.id')
            ->leftJoin('entities', 'entity_properties.entity_id', '=', 'entities.id')
            ->join('letting_statuses', 'properties.status', '=', 'letting_statuses.id')
            ->selectRaw('letting_statuses.*, entities.*, entity_properties.*, operation_insurances.*, properties.*, locations.*, acquisitions.*')
            ->where('acquisitions.id', '=', $id)
            ->where('acquisitions.property_id', '=', 'properties.id')
            ->toSql();

        $entities = DB::table('entities')->select('entity', 'id')->distinct()->orderBy('entity', 'asc')->get();

        LogFacade::info($acquisition);
        LogFacade::info($acquisitionSQL);


        return view('acquisition.view', [
            'acquisition' => $acquisition,
            'data' => $entities
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acquisition = Acquisition::leftJoin('properties', 'acquisitions.property_id', '=', 'properties.id')
            ->leftJoin('operation_utilities', 'properties.id', '=', 'operation_utilities.property_id')
            ->leftJoin('entity_properties', 'entity_properties.property_id', '=', 'properties.id')
            ->leftJoin('entities', 'entity_properties.entity_id', '=', 'entities.id')
            ->leftJoin('developments', 'properties.id', '=', 'developments.property_id')
            ->selectRaw('developments.*, entities.*, entity_properties.*, operation_utilities.*, properties.*, acquisitions.*')
            ->where('acquisitions.id', '=', $id)
            ->first();
        $entities = DB::table('entities')->select('entity', 'id')->distinct()->orderBy('entity', 'asc')->get();
        $city = [
            'Liverpool' => 'Liverpool',
            'Lincoln' => 'Lincoln',
            'Swansea' => 'Swansea'
        ];
        $area = [
            'Liverpool' => [
                'Wavertree' => 'Wavertree',
                'Kensington' => 'Kensington',
                'Toxteth' => 'Toxteth',
                'City Centre' => 'City Centre',
            ],
            'Lincoln' => [
                'West End' => 'West End',
                'Monks Road' => 'Monks Road',
                'High Street' => 'High Street',
            ],
            'Swansea' => [
                'Brynmill' => 'Brynmill',
                'Sandfields' => 'Sandfields',
                'City Centre' => 'City Centre',
                'Mount Pleasant' => 'Mount Pleasant',
                'Uplands' => 'Uplands',
                'St Thomas' => 'St Thomas',
                'Port Tennant' => 'Port Tennant',
            ]
        ];
        $property_status = $letting_statuses = LettingStatus::all();
        $acquisition_status = [
            'Watching' => 'Watching',
            'Analysing' => 'Analysing',
            'Offer Made' => 'Offer Made',
            'Offer Rejected' => 'Offer Rejected',
            'Offer Accepted' => 'Offer Accepted',
            'Exchanged' => 'Exchanged',
            'Completed' => 'Completed'
        ];
        $single_asset_portfolio = [
            'Single Asset' => 'Single Asset',
            'Portfolio' => 'Portfolio',
            'Block' => 'Block'
        ];
        $col_status = [
            'No evidence received' => 'No evidence received',
            'Evidence requested' => 'Evidence requested',
            'Partial evidence received' => 'Partial evidence received',
            'All evidence received' => 'All evidence received',
            'COL submitted' => 'COL submitted',
            'COL granted' => 'COL granted'
        ];
        $financing_status = [
            'Cash' => 'Cash',
            'Bridge Loan' => 'Bridge Loan'
        ];
        $tennure = [
            'Freehold' => 'Freehold',
            'Leasehold' => 'Leasehold'
        ];

        $development_status = [
            'Pre-start (occupied)' => 'Pre-start (occupied)',
            'Pre-start (vacant)' => 'Pre-start (vacant)',
            'On Site' => 'On Site',
            'Completed' => 'Completed',
        ];

        return view('acquisition.edit', [
            'data' => $acquisition,
            'entities' => $entities,
            'city' => $city,
            'area' => $area,
            'property_status' => $property_status,
            'acquisition_status' => $acquisition_status,
            'single_asset_portfolio' => $single_asset_portfolio,
            'col_status' => $col_status,
            'financing_status' => $financing_status,
            'tennure' => $tennure,
            'development_status' => $development_status,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->ajax()) {
            try {

                $getOldRecord = Property::findOrFail($request->formData['property_id']);

                //check if property phase has changed
                $hasChanged = false;

                if ($request->formData['property_phase'] != $getOldRecord->property_phase) {
                    $hasChanged = true;
                }

                $propertyUpdate = DB::table('properties')
                    ->where('properties.id', '=', $request->formData['property_id'])
                    ->update([
                        'properties.property_phase' => $request->formData['property_phase'],
                        // 'locations.city' => $request->formData['city'],
                        // 'locations.area' => $request->formData['area'],
                        'properties.house_no_or_name' => $request->formData['house_no'],
                        'properties.street' => $request->formData['street'],
                        // 'locations.postcode' => $request->formData['postcode'],
                        'properties.no_bric_beds' => $request->formData['no_bric_beds'],
                        'properties.no_bric_bathrooms' => $request->formData['no_of_bric_bathroom'],
                        'properties.status' => $request->formData['status'],
                        'properties.purchase_date' => $purchase_date,
                    ]);

                if ($hasChanged) {
                    $propertyUpdate = DB::table('properties')
                        ->where('properties.id', '=', $request->formData['property_id'])
                        ->update([
                            'properties.updated_at' => date("Y-m-d h:i:s")
                        ]);
                }


                $entityProperties = DB::table('entity_properties')
                    ->where('entity_properties.property_id', '=', $request->formData['property_id'])
                    ->first();

                $entityPropertiesUpdate = DB::table('entity_properties')
                    ->where('entity_properties.id', '=', $entityProperties->id)
                    ->update([
                        'entity_properties.entity_id' => $request->formData['entity'],
                    ]);

                $acquisitionData = DB::table('acquisitions')
                    ->where('acquisitions.id', '=', $request->formData['id'])
                    ->first();

                $datenow = date('d/m/Y');

                $acquisitionUpdate = DB::table('acquisitions')
                    ->where('acquisitions.id', '=', $request->formData['id'])
                    ->update([
                        'acquisitions.acquisition_status' => $request->formData['acquisition_status'],
                        'acquisitions.single_asset_portfolio' => $request->formData['single_asset_portfolio'],
                        'acquisitions.portfolio' => $request->formData['portfolio'],
                        'acquisitions.existing_bedroom_no' => $request->formData['existing_bedroom_no'],
                        'acquisitions.asking_price' => $request->formData['asking_price'],
                        'acquisitions.offer_price' => $request->formData['offer_price'],
                        'acquisitions.agreed_purchase_price' => $request->formData['agreed_purchase_price'],
                        'acquisitions.difference' => $request->formData['difference'],
                        'acquisitions.stamp_duty' => $request->formData['stamp_duty'],
                        'acquisitions.acquisition_cost' => $request->formData['acquisition_cost'],
                        'acquisitions.agent' => $request->formData['agent'],
                        'acquisitions.agent_fee_percentage' => $request->formData['agent_fee_percentage'],
                        'acquisitions.agent_fee' => $request->formData['agent_fee'],
                        'acquisitions.bridge_loan' => $request->formData['bridge_loan'],
                        'acquisitions.estimated_period' => $request->formData['estimated_period'],
                        'acquisitions.loan_percentage' => $request->formData['loan_percentage'],
                        'acquisitions.estimated_interest' => $request->formData['estimated_interest'],
                        'acquisitions.estimated_tpc' => $request->formData['estimated_tpc'],
                        'acquisitions.offer_date' => $request->formData['offer_date'],
                        'acquisitions.target_completion_date' => $request->formData['target_completion_date'],
                        'acquisitions.completion_date' => $request->formData['completion_date'],
                        'acquisitions.col_status' => $request->formData['col_status'],
                        // 'acquisitions.col_status_log' => $request->formData['col_status_log'],
                        'acquisitions.financing_status' => $request->formData['financing_status'],
                        'acquisitions.capex_budget' => $request->formData['capex_budget'],
                        'acquisitions.bric_purchase_yield_percentage' => $request->formData['bric_purchase_yield_percentage'],
                        'acquisitions.tpc_bedspace' => $request->formData['tpc_bedspace'],
                        'acquisitions.purchase_price_bedspace' => $request->formData['purchase_price_bedspace'],
                        'acquisitions.bric_y1_proposed_rent_pppw' => $request->formData['bric_y1_proposed_rent_pppw'],
                        'acquisitions.tenancy_length_weeks' => $request->formData['tenancy_length_weeks'],
                        'acquisitions.tennure' => $request->formData['tennure'],
                        'acquisitions.ground_rent' => $request->formData['ground_rent'],
                        'acquisitions.ground_rent_due' => $request->formData['ground_rent_due'],

                        // 'acquisitions.bridge_loan_status' => $request->formData['bridge_loan_status'],
                        // 'acquisitions.equity' => $request->formData['equity_required'],

                    ]);

                // operations insurance
                if ($request->formData['acquisition_status'] === 'Completed' && $request->formData['completion_date'] != null) {
                    $operation_utility_data = DB::table('operation_utilities')
                        ->where('operation_utilities.property_id', '=', $request->formData['property_id'])
                        ->first();
                    if ($operation_utility_data != null) {
                        $operationsInsurancesUpdate = DB::table('operation_utilities')
                            ->where('operation_utilities.id', '=', $operation_utility_data->id)
                            ->update([
                                'operation_utilities.insurance_in_place' => $request->formData['insurance_in_place'],
                                'operation_utilities.insurance_value' => $request->formData['insurance_value'],
                                'operation_utilities.insurance_annual_cost' => $request->formData['insurance_in_cost'],
                                'operation_utilities.insurance_renewal_date' => $request->formData['insurance_renewal_date'],
                            ]);
                    } else {
                        $operation_utility = new OperationUtility();
                        $operation_utility->property_id = $request->formData['property_id'];
                        $operation_utility->insurance_in_place = $request->formData['insurance_in_place'];
                        $operation_utility->insurance_value = $request->formData['insurance_value'];
                        $operation_utility->insurance_annual_cost = $request->formData['insurance_in_cost'];
                        $operation_utility->insurance_renewal_date = $request->formData['insurance_renewal_date'];
                        $operation_utility->save();
                    }
                }

                // Development
                if ($request->formData['property_phase'] == "In Development") {
                    $developmentID = DB::table('developments')
                        ->where('developments.property_id', '=', $request->formData['property_id'])
                        ->select('developments.id as id')
                        ->first();
                    $developments = DB::table('developments')
                        ->where('developments.id', '=', $developmentID->id)
                        ->update([
                            'developments.project_start_date' => $request->formData['project_start_date'],
                            'developments.projected_completion_date' => $request->formData['projected_completion_date'],
                            'developments.development_status' => $request->formData['development_status'],
                        ]);
                }

                return [
                    "status" => 1,
                    "data" => 'Success',
                    "id" => $request->formData['property_id']
                ];
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 200);
            }
        }
    }
    public function updateAcquisition(Request $request)
    {

        // Acquisition edit form validation
        $validated = $request->validate([
            'acquisition_status' => 'required',
            'agent' => 'required',
            'single_asset_portfolio' => 'required',
            'existing_bedroom_no' => 'required',
            'asking_price' => 'required',
            'estimated_period' => 'required|numeric',
            'capex_budget' => 'required',
            'tennure' => 'required',
        ]);

        LogFacade::info($request->id);
        $acquisition = Acquisition::find($request->id);

        LogFacade::info($acquisition);

        $acquisition->fill($validated);
        $acquisition->save();


        if ($request->has('description')) {
            $log = LogModel::find($request->log_id);
            $log->fill($request->all());
            $log->save();

            // activity()
            //     ->causedBy(Auth::user())
            //     ->performedOn($log)
            //     ->tap(function (Activity $activity) {
            //         $activity->location = 'Acquisition Page';
            //     })
            //     ->log('Acquisition has been updated');
        }

        if ($request->has('postcode')) {
            $location = Location::find($request->location_id);
            $location->fill($request->all());
            $location->save();

            // activity()
            //     ->causedBy(Auth::user())
            //     ->performedOn($location)
            //     ->tap(function (Activity $activity) {
            //         $activity->location = 'Acquisition Page';
            //     })
            //     ->log('Location has been updated');
        }

        return response()->json([
            'status' => 1,
            'message' => 'success',
            'id' => $request->id
        ], 200);
    }

    public function updateSideAcquisition(Request $request)
    {
        if ($request->ajax()) {
            try {
                if ($request->saveID == 1) {
                    $data = DB::table('acquisitions')
                        ->where('acquisitions.id', '=', $request->formData['id'])
                        ->first();

                    $properties = DB::table('properties')
                        ->where('properties.id', '=', $request->formData['property_id'])
                        ->first();
                    if ($data->asking_price != '' && $request->formData['agreed_purchase_price'] != '') {
                        $difference = $data->asking_price - $request->formData['agreed_purchase_price'];
                    } else {
                        $difference = '';
                    }
                    if ($request->formData['agreed_purchase_price'] != '' && $data->agent_fee_percentage != '') {
                        $agentFee = intval(round(($request->formData['agreed_purchase_price'] * ($data->agent_fee_percentage / 100)) * 1.2));
                    } else {
                        $agentFee = '';
                    }
                    if ($request->formData['agreed_purchase_price'] != '' && $data->loan_percentage != '' && $data->bridge_loan != '' && $data->estimated_period != '') {
                        $estimatedInterest = intval(round(($request->formData['agreed_purchase_price'] * ($data->loan_percentage / 100)) * ($data->bridge_loan / 100) * $data->estimated_period));
                    } else {
                        $estimatedInterest = '';
                    }
                    if ($request->formData['agreed_purchase_price'] != '' && $data->stamp_duty != '' && $data->acquisition_cost != '' && $agentFee != '' && $data->capex_budget != '' && $estimatedInterest != '') {
                        $estimatedTpc = intval(round($request->formData['agreed_purchase_price'] + $data->stamp_duty + $data->acquisition_cost + $agentFee + $data->capex_budget + $estimatedInterest));
                    } else {
                        $estimatedTpc = '';
                    }
                    if ($data->bric_y1_proposed_rent_pppw != '' && $data->tenancy_length_weeks != '' && $properties->no_bric_beds != '' && $estimatedTpc != '') {
                        $bricPurchaseYield = round((($data->bric_y1_proposed_rent_pppw * $data->tenancy_length_weeks * $properties->no_bric_beds) / $estimatedTpc) * 100, 3);
                    } else {
                        $bricPurchaseYield = '';
                    }
                    if ($estimatedTpc != '' && $properties->no_bric_beds != '') {
                        $tpcBedSpace = intval(round($estimatedTpc / $properties->no_bric_beds));
                    } else {
                        $tpcBedSpace = '';
                    }
                    if ($request->formData['agreed_purchase_price'] != '' && $data->existing_bedroom_no != '') {
                        $ebn = intval(round($request->formData['agreed_purchase_price'] / $data->existing_bedroom_no));
                    } else {
                        $ebn = '';
                    }

                    $location = Location::updateOrCreate([
                        'postcode' => $request->formData['postcode'],
                        'city' => $request->formData['city'],
                        'area' => $request->formData['area']
                    ]);

                    $properties = DB::table('properties')
                        ->where('properties.id', '=', $request->formData['property_id'])
                        ->update([
                            'properties.house_no_or_name' => $request->formData['house_no_or_name'],
                            'properties.street' => $request->formData['street'],
                            // 'properties.city' => $request->formData['city'],
                            'properties.location_id' => $location->id,
                            'properties.status' => $request->formData['status'],
                            'properties.no_bric_beds' => $request->formData['no_bric_beds'],
                        ]);

                    $entity_properties = DB::table('entity_properties')
                        ->where('entity_properties.id', '=', $request->formData['entity_property_id'])
                        ->update([
                            'entity_properties.entity_id' => $request->formData['entity'],
                        ]);

                    $acquisitions = DB::table('acquisitions')
                        ->where('acquisitions.id', '=', $request->formData['id'])
                        ->update([
                            'acquisitions.agreed_purchase_price' => $request->formData['agreed_purchase_price'],
                            'acquisitions.agent' => $request->formData['agent'],
                            'acquisitions.target_completion_date' => $request->formData['target_completion_date'],
                            'acquisitions.col_status' => $request->formData['col_status'],
                            'acquisitions.difference' => $difference,
                            'acquisitions.agent_fee' => $agentFee,
                            'acquisitions.estimated_interest' => $estimatedInterest,
                            'acquisitions.estimated_tpc' => $estimatedTpc,
                            'acquisitions.bric_purchase_yield_percentage' => $bricPurchaseYield,
                            'acquisitions.tpc_bedspace' => $tpcBedSpace,
                            'acquisitions.purchase_price_bedspace' => $ebn,
                        ]);

                    $dataValues = [
                        'id' => $request->formData['id'],
                        'entity_property_id' => $request->formData['entity_property_id'],
                        'property_id' => $request->formData['property_id'],
                        'entity' => $request->formData['entity'],
                        'house_no_or_name' => $request->formData['house_no_or_name'],
                        'street' => $request->formData['street'],
                        'city' => $request->formData['city'],
                        'area' => $request->formData['area'],
                        'postcode' => $request->formData['postcode'],
                        'status' => $request->formData['status'],
                        'no_bric_beds' => $request->formData['no_bric_beds'],
                        'agreed_purchase_price' => $request->formData['agreed_purchase_price'],
                        'agent' => $request->formData['agent'],
                        'target_completion_date' => $request->formData['target_completion_date'],
                        'col_status' => $request->formData['col_status']
                    ];

                    $activity = new ActivityLog();
                    $activity->user_id = Auth::user()->id;
                    $activity->description = 'Updated Acquisituion Details';
                    $activity->location = 'Acquisition List Page';
                    $activity->save();
                    return [
                        "status" => 1,
                        "data" => $dataValues,
                    ];
                } elseif ($request->saveID == 2) {
                    $propertyID = DB::table('acquisitions')
                        ->where('acquisitions.id', '=', $request->formData['id'])
                        ->select('property_id')
                        ->first();
                    if ($request->formData['completion_date'] == null) {
                        $completionDate = null;
                    } else {
                        $completionDate = $request->formData['completion_date'];
                    }

                    $acquisitions = DB::table('acquisitions')
                        ->where('acquisitions.id', '=', $request->formData['id'])
                        ->update([
                            'acquisitions.col_status_log' => $request->formData['col_status_log'],
                            'acquisitions.col_status' => $request->formData['col_status'],
                            'acquisitions.acquisition_status' => $request->formData['acquisition_status'],
                            'acquisitions.single_asset_portfolio' => $request->formData['single_asset_portfolio'],
                            'acquisitions.existing_bedroom_no' => $request->formData['existing_bedroom_no'],
                            'acquisitions.asking_price' => $request->formData['asking_price'],
                            'acquisitions.offer_price' => $request->formData['offer_price'],
                            'acquisitions.agreed_purchase_price' => $request->formData['agreed_purchase_price'],
                            'acquisitions.difference' => $request->formData['difference'],
                            'acquisitions.stamp_duty' => $request->formData['stamp_duty'],
                            'acquisitions.acquisition_cost' => $request->formData['acquisition_cost'],
                            'acquisitions.agent' => $request->formData['agent'],
                            'acquisitions.agent_fee_percentage' => $request->formData['agent_fee_percentage'],
                            'acquisitions.agent_fee' => $request->formData['agent_fee'],
                            'acquisitions.bridge_loan' => $request->formData['bridge_loan'],
                            'acquisitions.estimated_period' => $request->formData['estimated_period'],
                            'acquisitions.loan_percentage' => $request->formData['loan_percentage'],
                            'acquisitions.estimated_interest' => $request->formData['estimated_interest'],
                            'acquisitions.estimated_tpc' => $request->formData['estimated_tpc'],
                            'acquisitions.offer_date' => $request->formData['offer_date'],
                            'acquisitions.target_completion_date' => $request->formData['target_completion_date'],
                            'acquisitions.completion_date' => $completionDate,
                            'acquisitions.financing_status' => $request->formData['financing_status'],
                            'acquisitions.bric_purchase_yield_percentage' => $request->formData['bric_purchase_yield_percentage'],
                            'acquisitions.tpc_bedspace' => $request->formData['tpc_bedspace'],
                            'acquisitions.purchase_price_bedspace' => $request->formData['purchase_price_bedspace'],
                        ]);

                    $properties = DB::table('properties')
                        ->where('properties.id', '=', $propertyID->property_id)
                        ->update([
                            'properties.house_no_or_name' => $request->formData['house_no_or_name'],
                            'properties.street' => $request->formData['street'],
                            'properties.area' => $request->formData['area'],
                            'properties.no_bric_beds' => $request->formData['no_of_bric_beds'],
                            'properties.postcode' => $request->formData['postcode'],
                        ]);

                    $entity_property_id = DB::table('entity_properties')
                        ->where('entity_properties.property_id', '=', $propertyID->property_id)
                        ->selectRaw('entity_properties.id as id')
                        ->first();

                    $entity_properties = DB::table('entity_properties')
                        ->where('entity_properties.id', '=', $entity_property_id->id)
                        ->update([
                            'entity_properties.entity_id' => $request->formData['entity'],
                        ]);

                    $dataValues = [
                        'id' => $request->formData['id'],
                        'agreed_purchase_price' => $request->formData['agreed_purchase_price'],
                        'agent' => $request->formData['agent'],
                        'target_completion_date' => $request->formData['target_completion_date'],
                        'col_status' => $request->formData['col_status']
                    ];

                    $checkCompleted = $request->formData['acquisition_status'] == 'Completed' ? 1 : 0;

                    $activity = new ActivityLog();
                    $activity->user_id = Auth::user()->id;
                    $activity->description = 'Updated Acquisituion Details';
                    $activity->location = 'Acquisition List Page';
                    $activity->save();
                    return [
                        "status" => 1,
                        "completed" => $checkCompleted,
                        "data" => $dataValues,
                    ];
                }
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 200);
            }
        }
    }

    public function updatePlanning(Request $request, $id)
    {
        if ($request->ajax()) {
            $planning = Planning::updatePlanning($request, $id);
            return response()->json([
                'status' => 1,
                'data' => 'Success',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removePlanning(Request $request, $id)
    {
        if ($request->ajax()) {
            $planningRemove = Planning::where('id', '=', $id)->delete();
            return response()->json([
                'success' => 1,
                'message' => 'Success'
            ]);
        }
    }
    public function destroy($id)
    {
        //
    }
}
