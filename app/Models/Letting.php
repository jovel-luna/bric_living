<?php

namespace App\Models;

use App\Entity;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Log;

class Letting extends Model
{
    use HasFactory;

    protected $fillable = [
        'version',
        'property_contract_status',
        'target_weekly_rent',
        'achieved_weekly_rent',
        'floorplan',
        'date_of_refurb',
        'tv',
        'archive'
        // 'cay_letting_status',
        // 'cay_contract_status_log',
        // 'cay_beds_let',
        // 'cay_beds_vacant',
        // 'cay_target_weekly_rent_pppw',
        // 'cay_secured_weekly_rent_pppw',
        // 'cay_target_annual_rent',
        // 'cay_secured_annual_rent',
        // 'cay_rent_difference',
        // 'cay_tenancy_start_date',
        // 'cay_tenancy_end_date',
        // 'cay_tenancy_period',
        // 'nay_letting_status',
        // 'nay_contract_status_log',
        // 'nay_beds_let',
        // 'nay_beds_vacant',
        // 'nay_target_weekly_rent_pppw',
        // 'nay_secured_weekly_rent_pppw',
        // 'nay_target_annual_rent',
        // 'nay_secured_annual_rent',
        // 'nay_rent_difference',
        // 'nay_tenancy_start_date',
        // 'nay_tenancy_end_date',
        // 'nay_tenancy_period',
        // 'date_listed_on_rightmove',
        // 'date_updated_on_rightmove',
        // 'virtual_tour',
        // 'similar_properties'
    ];
    public function getLettings($request){

        $lettings = DB::table('properties')
        ->leftJoin('entity_properties', 'entity_properties.property_id', '=', 'properties.id')
        ->leftJoin('entities', 'entity_properties.entity_id', '=', 'entities.id')
        ->leftJoin('letting_statuses', 'properties.status', '=', 'letting_statuses.id')
        ->leftJoin('acquisitions', 'properties.id', '=', 'acquisitions.property_id')
        ->leftJoin('developments', 'properties.id', '=', 'developments.property_id')
        ->leftJoin('lettings', 'properties.id', '=', 'lettings.property_id')
        ->select(
            'properties.id',
            DB::raw("CASE property_phase WHEN 'Bric Property' THEN 1 WHEN 'External Property' THEN 2 END AS is_property_phase_order"),
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
            'lettings.version',
            'lettings.property_contract_status',
            'lettings.target_weekly_rent',
        );

        $lettings = $lettings->where(function($query) {
            $query->where('properties.property_phase', '=', 'Bric Property')
                ->orWhere('properties.property_phase', '=', 'External Property')
                ->orWhere('properties.property_phase', '=', 'In Development');
        })->where('lettings.archive', '=', 0);

        $filters = [
            'property_phase' => 'properties.property_phase',
            'entity' => 'entities.entity',
            'city' => 'properties.city',
            'area' => 'properties.area',
            'no_bric_beds' => 'properties.no_bric_beds',
            'status' => 'properties.status',
            'postcode' => 'properties.postcode',
        ];
        
        foreach ($filters as $key => $column) {
            if ($request->filled($key)) {
                $lettings = $lettings->where(function($query) use ($request, $key, $column) {
                    foreach ($request->$key as $value) {
                        $query->orWhere($column, '=', $value);
                    }
                });
            }
        }

        if ($request->filled('address')) {
            $lettings = $lettings->where(function($query) use ($request) {
                foreach ($request->address as $address) {
                    $query->orWhere(DB::raw("CONCAT(house_no_or_name,' ',street)"), 'like', '%' . $address . '%');
                }
            });
        }

        if ($request->filled('search')) {
            $lettings = $lettings->where(function($query) use ($request) {
                $search = $request->search;
                $query->orWhere('properties.property_phase', 'like', '%' . $search . '%')
                      ->orWhere('properties.city', 'like', '%' . $search . '%')
                      ->orWhere('properties.area', 'like', '%' . $search . '%')
                      ->orWhere(DB::raw("CONCAT(house_no_or_name,' ',street)"), 'like', '%' . $search . '%')
                      ->orWhere('properties.postcode', 'like', '%' . $search . '%')
                      ->orWhere('properties.no_bric_beds', 'like', '%' . $search . '%')
                      ->orWhere('properties.no_bric_bathrooms', 'like', '%' . $search . '%')
                      ->orWhere('entities.entity', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('property_contract_status')) {
            $lettings = $lettings->where(function($query) use ($request) {
                foreach ($request->property_contract_status as $status) {
                    $query->orWhere('lettings.property_contract_status', '=', $status);
                }
            });
        }

        
        $lettingsSql = $lettings->orderBy('is_property_phase_order', 'asc')
                         ->orderBy('properties.updated_at', 'desc')
                         ->toSql();
        Log::info($lettingsSql);

        $lettings = $lettings->orderBy('is_property_phase_order', 'asc')
                            ->orderBy('properties.updated_at', 'desc')
                            ->get();

        return $lettings;
    }
    public function getLettingsHistory($request){

        $lettings = DB::table('properties')
        ->leftJoin('entity_properties', 'entity_properties.property_id', '=', 'properties.id')
        ->leftJoin('entities', 'entity_properties.entity_id', '=', 'entities.id')
        ->leftJoin('letting_statuses', 'properties.status', '=', 'letting_statuses.id')
        ->leftJoin('acquisitions', 'properties.id', '=', 'acquisitions.property_id')
        ->leftJoin('developments', 'properties.id', '=', 'developments.property_id')
        ->leftJoin('lettings', 'properties.id', '=', 'lettings.property_id')
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
            'lettings.version',
            'lettings.property_contract_status',
            'lettings.target_weekly_rent',
        )
        ->where('properties.property_phase', '=', 'Bric Property')
        ->where('lettings.archive', '=', 1);

        if ($request->property_phase) {
            $lettings = $lettings->where(function($pp) use ($request) {
                foreach ($request->property_phase as $ppKey => $ppVal) {
                    $pp->orWhere('properties.property_phase', '=', $ppVal);
                }
            });      
        }

        if ($request->entity) {
            $lettings = $lettings->where(function($e) use ($request) {
                foreach ($request->entity as $eKey => $eVal) {
                    $e->orWhere('entities.entity', '=', $eVal);
                }
            });      
        }
        
        if ($request->city) {
            $lettings = $lettings->where(function($c) use ($request) {
                foreach ($request->city as $cKey => $cVal) {
                    $c->orWhere('properties.city', '=', $cVal);
                }
            });      
        }
        if ($request->area) {
            $lettings = $lettings->where(function($a) use ($request) {
                foreach ($request->area as $aKey => $aVal) {
                    $a->orWhere('properties.area', '=', $aVal);
                }
            });      
        }
        if ($request->no_bric_beds) {
            $lettings = $lettings->where(function($nbb) use ($request) {
                foreach ($request->no_bric_beds as $nbbKey => $nbbVal) {
                    $nbb->orWhere('properties.no_bric_beds', '=', $nbbVal);
                }
            });      
        }
        if ($request->status) {
            $lettings = $lettings->where(function($s) use ($request) {
                foreach ($request->status as $sKey => $sVal) {
                    $s->orWhere('properties.status', '=', $sVal);
                }
            });      
        }
        if ($request->postcode) {
            $lettings = $lettings->where(function($pc) use ($request) {
                foreach ($request->postcode as $pcKey => $pcVal) {
                    $pc->orWhere('properties.postcode', '=', $pcVal);
                }
            });      
        }
        if ($request->address) {
            $lettings = $lettings->where(function($add) use ($request) {
                foreach ($request->address as $addKey => $addVal) {
                    $add->orWhere(DB::raw("CONCAT(house_no_or_name,' ',street)"), 'like', '%' . $addVal . '%');
                }
            });      
        }

        if ($request->search) {         
            $lettings = $lettings->where(function($q) use ($request) {
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

        if ($request->property_contract_status) {
            $lettings = $lettings->where(function($ct) use ($request) {
                foreach ($request->property_contract_status as $addKey => $addVal) {
                    $ct->orWhere('lettings.property_contract_status', $request->property_contract_status);
                }
            });      
        }

        $lettings = $lettings->orderBy('is_property_phase_order', 'asc')->orderBy('properties.updated_at', 'desc')->get();
        return $lettings;
    }

    public function getLettingById($id){
        $letting = Letting::where('lettings.id', '=', $id)->first();
        return $letting;
    }

    public function addLettingData($id){
        $lettings = new Letting();
        $lettings->property_id = $id;
        // $lettings->cay_target_weekly_rent_pppw = 'null';
        // $lettings->cay_target_annual_rent = 'null';
        $lettings->save();
        $id = $lettings->id;
        return $id;
    }

    public function bulkUpdateLettings($request){
        foreach ($request['data'] as $x => $xVal) {
            $checkLettings = DB::table('lettings')
            ->where('lettings.property_id', $xVal['id'])
            ->select('id')
            ->first();

            $lettings = DB::table('lettings')
                ->where('lettings.id', $checkLettings->id)
                ->update([
                    'version' => $xVal['version'] ? $xVal['version'] : null,
                    'property_contract_status' => $xVal['contract_status'] ? $xVal['contract_status'] : null,
                    'target_weekly_rent' => $xVal['target_weekly_rent'] ? $xVal['target_weekly_rent'] : null,
                ]);
        
            $checkDevelopments = DB::table('developments')
            ->where('developments.property_id', $xVal['id'])
            ->select('id','projected_completion_date')
            ->first();

            if ($checkDevelopments->projected_completion_date != $xVal['available']) {
                $developments = DB::table('developments')
                ->where('developments.id', $checkDevelopments->id)
                ->update(['projected_completion_date' => $xVal['available']]);
            }

            $checkProperties = DB::table('properties')
            ->where('properties.id', $xVal['id'])
            ->first();

            if ($checkProperties->no_bric_beds != $xVal['bric_bed']) {
                $properties = DB::table('properties')
                ->where('properties.id', $checkProperties->id)
                ->update(['no_bric_beds' => $xVal['bric_bed']]);
            }
            if ($checkProperties->no_bric_bathrooms != $xVal['bric_bath']) {
                $properties = DB::table('properties')
                ->where('properties.id', $checkProperties->id)
                ->update(['no_bric_bathrooms' => $xVal['bric_bath']]);
            }
        }

        return $lettings;
    }
    public function bulkArchiveLettings($request){
        foreach ($request['data'] as $x => $xVal) {
            $checkLettings = DB::table('lettings')
            ->where('lettings.property_id', $xVal['id'])
            ->select('id')
            ->first();

            $lettings = DB::table('lettings')
                ->where('lettings.id', $checkLettings->id)
                ->update([
                    'archive' => 1,
                ]);
            $lettings = Letting::find($checkLettings->id);
            $lettings->archive = 1;
            $lettings->save();
            $lettings->touch();
        }

        return $lettings;
    }
    public function unarchive($request){
        $checkLettings = DB::table('lettings')
        ->where('lettings.property_id', $request['pid'])
        ->select('id')
        ->first();

        $lettings = Letting::find($checkLettings->id);
        $lettings->archive = 0;
        $lettings->save();
        $lettings->touch();

        return $lettings;
    }
    public function updateLettings($request){
        $lettings = Letting::find($request['data']['id']);
        switch ($request['data']['field']) {
            case 'date_of_refurb':
                $lettings->date_of_refurb = $request['data']['value'];
            break; 
            case 'tv':
                $lettings->tv = $request['data']['value'];
            break; 
            case 'target_weekly_rent':
                $lettings->target_weekly_rent = $request['data']['value'];
            break; 
            case 'achieved_weekly_rent':
                $lettings->achieved_weekly_rent = $request['data']['value'];
            break; 
        }
        $lettings->save();
        $lettings->touch();

        return $lettings;
    }

    public function import($data, $entitiy){
        foreach ($data[0] as $pck => $pcVal) {            
            $propertyID = DB::table('properties')->where('ref_no', $pcVal[0])->select('properties.id')->first();
            if ($propertyID) {
                $lettingsID = DB::table('lettings')->where('property_id', $propertyID->id)->select('id')->first();
                // update lettings
                if ($lettingsID) {
                    $lettings = DB::table('lettings')
                    ->where('lettings.id', '=', $lettingsID->id)
                    ->update([
                        'lettings.property_id' => $propertyID->id,
                        'lettings.property_contract_status' => $pcVal[1] ? $pcVal[1] : null,
                        'lettings.version' => $pcVal[2] ? $pcVal[2] : null,
                        'lettings.date_of_refurb' => $pcVal[3] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pcVal[3])->format('d-m-Y') : null,
                        'lettings.tv' => $pcVal[4] === 'Yes' ? 1 : 0,
                        'lettings.target_weekly_rent' => $pcVal[5] ? number_format($pcVal[5]) : null,
                        'lettings.achieved_weekly_rent' => $pcVal[6] ? number_format($pcVal[6]) : null,
                        'lettings.archive' => 0,
                    ]);
                }
            }
        }

        return true;
    }
}
