<?php

namespace App\Http\Controllers;

use App\Imports\EntitiesImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Entity;
use App\Models\Property;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Log;
use DataTables;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $entityData = Entity::orderBy('id', 'desc')->get();
            foreach ($entityData as $eK => $eVal) {
                $noOfPipeline = '';
                $noOfCurrentRentRole = '';

                $allProperties = Property::leftJoin('entity_properties', 'properties.id', '=', 'entity_properties.property_id')
                ->leftJoin('entities', 'entities.id', '=', 'entity_properties.entity_id')
                ->where([
                    ['properties.property_phase', '=', 'Bric Property'],
                    ['entities.entity', '=', $eVal['entity']]
                ]);
                $noOfProperties = $allProperties->count();
                $entityData[$eK]['no_of_properties'] = $noOfProperties;
                
                $noOfBeds = $allProperties->sum('no_bric_beds');
                $entityData[$eK]['no_bric_beds'] = $noOfBeds;

                $developmentPipeline = Property::leftJoin('entity_properties', 'properties.id', '=', 'entity_properties.property_id')
                ->leftJoin('entities', 'entities.id', '=', 'entity_properties.entity_id')
                ->where('entities.entity', '=', $eVal['entity'])
                ->where('property_phase', '=', 'In Development');

                $acquisitionPipeline = Property::leftJoin('entity_properties', 'properties.id', '=', 'entity_properties.property_id')
                ->leftJoin('entities', 'entities.id', '=', 'entity_properties.entity_id')
                ->where('entities.entity', '=', $eVal['entity'])
                ->where('property_phase', '=', 'Acquiring');

                Log::info($developmentPipeline->toSql());
                Log::info($developmentPipeline->getBindings());

                Log::info($acquisitionPipeline->toSql());
                Log::info($acquisitionPipeline->getBindings());

                $dev = $developmentPipeline->sum('no_bric_beds');
                $acqui = $acquisitionPipeline->sum('no_bric_beds');
                $entityData[$eK]['dev_pipeline'] = $dev;
                $entityData[$eK]['acquisition_pipeline'] = $acqui;
                $entityData[$eK]['current_rent_role'] = '';
            }
            
            return Datatables::of($entityData)
                    ->addIndexColumn()
                    ->setRowAttr([
                        'data-id' => function($entityData) {
                            return $entityData->id;
                        },
                    ])
                    ->make(true);
        }
        return view('entity.index');
    }

    public function getEntityById(Request $request){
        if ($request->ajax()) {
            $entity = Entity::find($request->id);
            return response()->json([
                'data' => $entity,
            ]); 
        }
    }

    public function importEntities()
    {
        return view("entity.import");
    }

    public function uploadEntities(Request $request)
    {
        Excel::import(new EntitiesImport, $request->file);
        
        return redirect()->route('entity.index')->with('success', 'Entities Imported Successfully');
    }

    public function getEntitySampleFormat()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "/storage/files/Entity Sample Format.xlsx";

        $headers = array(
                'Content-Type: application/xlsx',
                );

        return Response::download($file, 'Entity Sample Format.xlsx', $headers);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
			'company_registration_number' => 'required|string|unique:entities|max:255',
			'entity' => 'required|string|unique:entities|max:255',
			'registered_address' => 'required|string|max:255',
			'entity_date_created' => 'required',
			'statement_due_date' => 'max:255',
			'financial_year_start_date' => 'required',
			'financial_year_end_date' => 'required',
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect()->route('entity.create')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();

			try{
				$entity = new Entity;
                $entity->company_registration_number = $data['company_registration_number'];
                $entity->entity = $data['entity'];
                $entity->registered_address = $data['registered_address'];
                $entity->entity_date_created = date('Y-m-d', strtotime($data['entity_date_created']));
                $entity->statement_due_date = date('Y-m-d', strtotime($data['statement_due_date']));
                $entity->financial_year_start_date = date('Y-m-d', strtotime($data['financial_year_start_date']));
                $entity->financial_year_end_date = date('Y-m-d', strtotime($data['financial_year_end_date']));

				$entity->save();

                return redirect()->route('entity.index')->with('success', 'Entity Added Successfully');
			}
			catch(Exception $e){
                return redirect()->route('entity.index')->with('error', 'Entity Adding Failed');
			}
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
        $entity = Entity::findOrFail($id);
        return view('entity.view',  compact('entity'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEntity(Request $request, $id)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'company_registration_number' => 'required|max:255|unique:entities,company_registration_number,' . $request->id,
                'entity' => 'required|max:255|unique:entities,entity,' . $request->id,
            ]);

            if ($validator->fails()){
                return response()->json(['errors'=>$validator->errors()]);
            }else{

                $entity = Entity::find($request->id);
 
                $entity->company_registration_number = $request->company_registration_number;
                $entity->entity = $request->entity;

                $entity->registered_address = $request->registered_address;
                $entity->statement_due_date = $request->statement_due_date;
                $entity->financial_year_start_date = $request->financial_year_start_date;
                $entity->financial_year_end_date = $request->financial_year_end_date;

                $entity->save();

                return response()->json([
                    "status" => 1,
                    'message' => "Success"
                ]);
            }
            // dd($validated);

            // return [
            //     "status" => 1,
            //     "data" => 'Success'
            // ];
        }
    }

    public function update(Request $request, $id)
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
