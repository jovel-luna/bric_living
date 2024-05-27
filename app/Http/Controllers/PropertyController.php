<?php

namespace App\Http\Controllers;

use App\Imports\PropertiesImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Property;
use App\Models\Entity;
use App\Models\EntityProperties;
use App\Models\Acquisition;
use App\Models\OperationUtility;
use App\Models\OperationBudget;
use App\Models\OperationExpenditure;
use App\Models\OperationInsurance;
use App\Models\LettingStatus;
use App\Models\Location;
use App\Models\Development;
use App\Models\Letting;
use App\Models\Link;
use App\Models\Gallery;
use App\Models\Tenant;
use App\Models\Finance;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Log;
use DataTables;
use Illuminate\Support\Facades\Response;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use Auth;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('property.index');
    }
    public function viewExternal()
    {
        $path = public_path('js/postcodes.json');
        $jsonString = file_get_contents($path);
        $jsonData = json_decode($jsonString);
        $letting_statuses = LettingStatus::all();
        $entities = DB::table('entities')->select('entity', 'id')->distinct()->orderBy('entity', 'asc')->get();
        $data = [
            'entities' => $entities,
            'letting_statuses' => $letting_statuses,
            'locations' => $jsonData
        ];
        return view('property.external', compact('data'));
    }

    public function importProperties()
    {
        return view("property.import");
    }

    public function isExisting(Request $request)
    {
        $recordExist = Property::isExisting($request);
        return response()->json([
            'recordExist' => $recordExist
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $path = public_path('js/postcodes.json');
        $jsonString = file_get_contents($path);
        $jsonData = json_decode($jsonString);
        $letting_statuses = LettingStatus::all();
        $entities = DB::table('entities')->select('entity', 'id')->distinct()->orderBy('entity', 'asc')->get();
        $postcodes = DB::table('locations')->select('postcode', 'id')->distinct()->orderBy('postcode', 'asc')->get();
        $data = [
            'entities' => $entities,
            'letting_statuses' => $letting_statuses,
            'locations' => $jsonData,
            'postcode' => $postcodes
        ];
        return view('property.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if ($request->type === 'Internal') {
                switch ($request->formData['property_phase']) {
                    case 'In Development':
                        if ($request->formData['completion_date']) {
                            $purchase_date = date('Y-m-d', strtotime($request->formData['completion_date']));
                        }else{
                            $purchase_date = '00/00/0000';
                        }
                        break;
                    case 'Acquiring':
                        $purchase_date = '00/00/0000';
                        break;
                    default:
                        $purchase_date = date('Y-m-d', strtotime($request->formData['completion_date']));
                        break;
                }
                $pdata = Property::select('ref_no')->where('type', 'Internal')->orderBy('id', 'desc')->first();
                if ($pdata) {
                    $nextRefNo = $pdata->ref_no +1; 
                }else{
                    $nextRefNo = '1000';
                }
    
                $properties = new Property();
                $properties->ref_no = $nextRefNo;
                $properties->type = 'Internal';
                $properties->property_phase = $request->formData['property_phase'];
                // $properties->city = $request->formData['city'];
                // $properties->area = $request->formData['area'];
                $properties->house_no_or_name = $request->formData['house_no'];
                $properties->street =  $request->formData['street'];
                $properties->location_id =  $request->formData['postcode'];
                $properties->no_bric_beds =  $request->formData['no_of_bric_beds'];
                $properties->no_bric_bathrooms =  $request->formData['no_of_bric_bathroom'];
                $properties->status = $request->formData['status'];
                $properties->purchase_date = $purchase_date;

                $properties->save();
                $propertyID = $properties->id;

                Letting::addLettingData($propertyID); // create letting after property creation 
    
                $ep = new EntityProperties();
                $ep->entity_id = $request->formData['entity'];
                $ep->property_id = $propertyID;
                $ep->save();
    
                // $colStatusLog = $request->formData['col_status_log'];
                $acquisition = new Acquisition();
                $acquisition->property_id = $propertyID;
                $acquisition->acquisition_status = $request->formData['acquisition_status'];
                $acquisition->single_asset_portfolio = $request->formData['single_asset_portfolio'];
                $acquisition->portfolio = $request->formData['portfolio'];
                $acquisition->existing_bedroom_no = $request->formData['existing_bedroom_no'];
                $acquisition->asking_price = $request->formData['asking_price'];
                $acquisition->offer_price = $request->formData['offer_price'];
                $acquisition->agreed_purchase_price = $request->formData['agreed_purchase_price'];
                $acquisition->difference = $request->formData['difference'];
                $acquisition->stamp_duty = $request->formData['stamp_duty'];
                $acquisition->acquisition_cost = $request->formData['acquisition_cost'];
                $acquisition->agent = $request->formData['agent'];
                $acquisition->agent_fee_percentage = $request->formData['agent_fee_percentage'];
                $acquisition->agent_fee = $request->formData['agent_fee'];
                $acquisition->bridge_loan = $request->formData['bridge_loan'];
                $acquisition->estimated_period = $request->formData['estimated_period'];
                $acquisition->loan_percentage = $request->formData['loan_percentage'];
                $acquisition->estimated_interest = $request->formData['estimated_interest'];
                $acquisition->estimated_tpc = $request->formData['estimated_tpc'];
                $acquisition->offer_date = $request->formData['offer_date'];
                $acquisition->target_completion_date = $request->formData['target_completion_date'];
                $acquisition->completion_date = $request->formData['completion_date'];
                $acquisition->col_status = $request->formData['col_status'];
                // $acquisition->col_status_log = $colStatusLog;
                $acquisition->financing_status = $request->formData['financing_status'];
                $acquisition->capex_budget = $request->formData['capex_budget'];
                $acquisition->bric_purchase_yield_percentage = $request->formData['bric_purchase_yield_percentage'];
                $acquisition->tpc_bedspace = $request->formData['tpc_bedspace'];
                $acquisition->purchase_price_bedspace = $request->formData['purchase_price_bedspace'];
                $acquisition->bric_y1_proposed_rent_pppw = $request->formData['bric_y1_proposed_rent_pppw'];
                $acquisition->tenancy_length_weeks = $request->formData['tenancy_length_weeks'];
                $acquisition->tennure = $request->formData['tennure'];
                $acquisition->ground_rent = $request->formData['ground_rent'];
                $acquisition->ground_rent_due = $request->formData['ground_rent_due'];
                $acquisition->save();
                $acquisitionID = $acquisition->id;
    
                // operations insurance
                $operation_utility = new OperationUtility();
                if ($request->formData['acquisition_status'] === 'Completed' && $request->formData['completion_date'] != null) {
                    $operation_utility->property_id = $propertyID;
                    $operation_utility->insurance_in_place = $request->formData['insurance_in_place'];
                    $operation_utility->insurance_value = $request->formData['insurance_value'];
                    $operation_utility->insurance_annual_cost = $request->formData['insurance_in_cost'];
                    $operation_utility->insurance_renewal_date = $request->formData['insurance_renewal_date'];
                    $operation_utility->save();
                }else{
                    $operation_utility->property_id = $propertyID;
                    $operation_utility->save();
                }
    
                $development = new Development();
                $development->property_id = $propertyID;
                $development->save();
    
                $activity = new ActivityLog();
                $activity->user_id = Auth::user()->id;
                $activity->description = 'Created new internal property';
                $activity->location = 'Create New Internal Property Page';
                $activity->save();

                $location = Location::where('id', $request->formData['postcode'] )->first();

                DB::table('detailed_activity_logs')->insert([

                    // Property Info
                    [ 'log_id' => $activity->id, 'activity_field' => 'Property Reference Number', 'details' => $nextRefNo ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'Property Type', 'details' => 'Internal' ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'Property Phase', 'details' => $request->formData['property_phase'] ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'House Number', 'details' => $request->formData['house_no'] ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'Street', 'details' => $request->formData['street'] ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'Postcode', 'details' => $location->postcode ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'City', 'details' => $location->city ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'Area', 'details' => $location->area ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'No. of Bric Beds', 'details' => $request->formData['no_of_bric_beds'] ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'No. of Bric Bathrooms', 'details' => $request->formData['no_of_bric_bathroom'] ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'Status', 'details' => $request->formData['status'] ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'Purchase Date', 'details' => $purchase_date ],

                    // Acquisition
                    ['log_id' => $activity->id, 'activity_field' => 'Acquisition Status', 'details' => $request->formData['acquisition_status'] ?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Single Asset Portfolio', 'details' => $request->ormData['single_asset_portfolio'] ?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Portfolio', 'details' => $request->ormData['portfolio']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Existing Bedroom No', 'details' => $request->formData['existing_bedroom_no']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Asking Price', 'details' => $request->formData['asking_price']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Offer Price', 'details' => $request->formData['offer_price']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Agreed Purchase Price', 'details' => $request->formData['agreed_purchase_price']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Difference', 'details' => $request->formData['difference']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Stamp Duty', 'details' => $request->formData['stamp_duty']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Acquisition Cost', 'details' =>$request->formData['acquisition_cost']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Agent', 'details' => $request->formData['agent']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Agent Fee Percentage', 'details' => $request->formData['agent_fee_percentage']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Agent Fee', 'details' => $request->formData['agent_fee']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Bridge Loan', 'details' => $request->formData['bridge_loan']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Estimated Period', 'details' =>$request->formData['estimated_period']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Loan Percentage', 'details' => $request->formData['loan_percentage']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Estimated Interest', 'details' => $request->formData['estimated_interest']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Estimated TPC', 'details' => $request->formData['estimated_tpc']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Offer Date', 'details' => $request->formData['offer_date']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Target Completion Date', 'details' => $request->formData['target_completion_date']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Completion Date', 'details' =>$request->formData['completion_date']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'COL Status', 'details' => $request->formData['col_status']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Financing Status', 'details' => $request->formData['financing_status']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Capex Budget', 'details' => $request->formData['capex_budget']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'BRIC Purchase Yield Percentage', 'details' => $request->formData['bric_purchase_yield_percentage']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'TPC Bedspace', 'details' => $request->formData['tpc_bedspace']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Purchase Price Bedspace', 'details' => $request->formData['purchase_price_bedspace']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'BRIC Y1 Proposed Rent PPPW', 'details' => $request->formData['bric_y1_proposed_rent_pppw']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Tenancy Length Weeks', 'details' =>$request->formData['tenancy_length_weeks']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Tenure', 'details' =>$request->formData['tennure']]?? null,
                    ['log_id' => $activity->id, 'activity_field' => 'Ground Rent', 'details' =>$request->formData['ground_rent']?? null],
                    ['log_id' => $activity->id, 'activity_field' => 'Ground Rent Due', 'details' =>$request->formData['ground_rent_due']?? null],                
                ]);

                return [
                    "status" => 1,
                    "data" => 'Success'
                ];
            }
            else{
                $formData = $request->input('formData');
                parse_str($formData, $unserializedData);
    
                // Convert the array to an object
                $formDataObject = json_decode(json_encode($unserializedData));

                $pdata = Property::select('ref_no')->where('type', 'External')->orderBy('id', 'desc')->first();
                if ($pdata) {
                    $refNo = str_replace("E","",$pdata->ref_no);
                    $refNoFormat = $refNo + 1;
                    $nextRefNo = "E".$refNoFormat; 
                }else{
                    $nextRefNo = 'E1000';
                }
                
                $properties = new Property();
                $properties->ref_no = $nextRefNo;
                $properties->type = 'External';
                $properties->property_phase = $formDataObject->property_phase;
                // $properties->city = $formDataObject->city;
                // $properties->area = $formDataObject->area;
                $properties->house_no_or_name = $formDataObject->house_no;
                $properties->street =  $formDataObject->street;
                $properties->location_id =  $formDataObject->postcode;
                $properties->no_bric_beds =  $formDataObject->no_of_bric_beds;
                $properties->no_bric_bathrooms =  $formDataObject->no_of_bric_bathroom;
                $properties->status = $formDataObject->status;
                $properties->purchase_date = '00/00/0000';

                $properties->save();
                $propertyID = $properties->id;
    
                $ep = new EntityProperties();
                $ep->entity_id = $formDataObject->entity;
                $ep->property_id = $propertyID;
                $ep->save();

                $activity = new ActivityLog();
                $activity->user_id = Auth::user()->id;
                $activity->description = 'Created new external property';
                $activity->location = 'Create New External Property Page';
                $activity->type = 'CREATE';
                $activity->save();

                $location = Location::where('id', $request->formData['postcode'] )->first();

                DB::table('detailed_activity_logs')->insert([
                    // Property Info
                    [ 'log_id' => $activity->id, 'activity_field' => 'Property Reference Number', 'details' => $nextRefNo ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'Property Type', 'details' => 'External' ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'Property Phase', 'details' => $request->formData['property_phase'] ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'House Number', 'details' => $request->formData['house_no'] ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'Street', 'details' => $request->formData['street'] ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'Postcode', 'details' => $location->postcode ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'City', 'details' => $location->city ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'Area', 'details' => $location->area ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'No. of Bric Beds', 'details' => $request->formData['no_of_bric_beds'] ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'No. of Bric Bathrooms', 'details' => $request->formData['no_of_bric_bathroom'] ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'Status', 'details' => $request->formData['status'] ],
                    [ 'log_id' => $activity->id, 'activity_field' => 'Purchase Date', 'details' => $purchase_date ],            
                ]);


                return [
                    "status" => 1,
                    "data" => 'Success'
                ];
            }
        }  catch (\Throwable $th) { 
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 200);
        }
        
    }

    public function propertyDetailsShow(Request $request, $id)
    {
        $referrer = $request->headers->get('referer');

        // Get the path from the link URL
        $path = parse_url($referrer, PHP_URL_PATH);

        // Get the first slug from the path
        $slugs = explode('/', trim($path, '/'));
        $firstSlug = $slugs[0];
        $currentSlug = $firstSlug;

        $property = Property::join('letting_statuses', 'properties.status', '=', 'letting_statuses.id')
        ->join('locations', 'properties.location_id', '=', 'locations.id')
        ->selectRaw('letting_statuses.*, properties.*, locations.*')
        ->where('properties.id', '=', $id)->first();
        Log::info($property);

        if ($property->type === 'Internal') {
            $acquisition = Acquisition::where('acquisitions.property_id', '=', $id)->first();
    
            $operation_utility = OperationUtility::where('operation_utilities.property_id', '=', $id)->first();
            $operation_budget = OperationBudget::where('operation_budgets.property_id', '=', $id)->orderBy('operation_budgets.budget_year', 'DESC')->get();
            $operation_expenditure = OperationExpenditure::where('operation_expenditures.property_id', '=', $id)->orderBy('operation_expenditures.expenditure_year', 'DESC')->get();
    
            $development = Development::where('developments.property_id', '=', $id)->first();
            $developmentHS = Development::where('developments.property_id', '=', $id)
                                        ->selectRaw('developments.hs_development_compliance')
                                        ->first();
    
            $letting = Letting::where('lettings.property_id', '=', $id)->first();
            // add lettings entry
            if (is_null($letting)) {
                $lettingID = Letting::addLettingData($id);
                $letting = Letting::getLettingById($lettingID);
            }
    
            $tenants = Tenant::where('tenants.property_id', '=', $id)->get();
            if (count($tenants)) {
                foreach ($tenants as $tKey => $tVal) {
                    if ($tVal['tenant_contract_status'] == 'Contract Signed' && $tVal['id_certified'] == 1 && $tVal['poa'] == 1 && $tVal['deposits_paid'] == '1' && $tVal['document_outstanding'] == '1') {
                        $tVal['status'] = 1;
                    }else{
                        $tVal['status'] = 0;
                    }
                }
            }
            $links = Link::where('links.property_id', '=', $id)->get();
            $galleries = [];
    
            $galleries['floorplan'] = Gallery::where('galleries.property_id', '=', $id)
                ->where('galleries.type', '=', 'Floorplan')->orderBy('created_at', 'desc')->get();
            $galleries['video'] = Gallery::where('galleries.property_id', '=', $id)
                ->where('galleries.type', '=', 'Video')->orderBy('created_at', 'desc')->get();
            $galleries['photo'] = Gallery::where('galleries.property_id', '=', $id)
                ->where('galleries.type', '=', 'Photo')->orderBy('created_at', 'desc')->get();
    
            $finance = Finance::where('finances.property_id', '=', $id)->first();
            // add finance entry
            if (is_null($finance)) {
                $financeID = Finance::addFinanceData($id);
                $finance = Finance::getFinanceById($financeID);
            }
            
            $refData = 'acquisition';
            if ($currentSlug) {
                switch (true) {
                    case ($currentSlug == 'home' || $currentSlug == 'acquisition'):
                        $refData = 'acquisition';
                        break;
                    case ($currentSlug == 'operations' || $currentSlug == 'operation') :
                        $refData = 'operations';
                        break;
                    case ($currentSlug == 'developments' || $currentSlug == 'development') :
                        $refData = 'development';
                        break;
                    case ($currentSlug == 'lettings' || $currentSlug == 'letting') :
                        $refData = 'lettings';
                        break;
                    case ($currentSlug == 'finances' || $currentSlug == 'finance') :
                        $refData = 'finance';
                        break;
                }
            }
            $data = [
                'id' => $id,
                'property' => $property,
                'acquisition' => $acquisition,
                'operation_utility' => $operation_utility,
                'operation_budget' => $operation_budget,
                'operation_expenditure' => $operation_expenditure,
                'development' => $development,
                'developmentHS' => isset($developmentHS) ? json_decode($developmentHS->hs_development_compliance) : null,
                'letting' => $letting,
                'links' => $links,
                'gallery' => $galleries,
                'tenants' => $tenants,
                'finance' => $finance,
                'referrer' => $refData,
                'currentSlug' => $currentSlug,
            ];
            $pid = $id;
            return view('property.details', compact('data', 'pid'));
        }else{
            $data = [
                'id' => $id,
                'property' => $property
            ];
            $pid = $id;
            return view('property.external-index', compact('data', 'pid'));
        }
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function editBudget($id)
    {
        //
    }

    public function editExpenditure($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function updateBudget(Request $request,$id)
    {
        //
    }

    public function updateExpenditure(Request $request,$id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
