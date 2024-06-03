<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\OperationBudget;
use App\Models\OperationExpenditure;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

class OperationUtility extends Model
{
    use LogsActivity;
    use HasFactory;

    protected static $logName = 'Operation Utility';
    protected static $logFillable = true;


    public function getDescriptionForEvent(string $eventName): string
    {
        return "Operation Utility has been {$eventName} ";
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName == 'updated'){
            $activity->location = "Operation Utility Edit Page";
        }
        if($eventName == 'created'){ 
            $activity->location = "Create Operation Utility Page";
        }
        if($eventName == 'deleted') {
            $activity->location = "Operation Utility Edit Page";
        }

    }

    public function import($data, $entitiy){
        $ref_no = '';
        foreach ($data[0] as $pck => $pcVal) {            
            $propertyID = DB::table('properties')->where('ref_no', $pcVal[0])->select('properties.id', 'properties.no_bric_beds')->first();
            if ($propertyID) {
                $operationID = DB::table('operation_utilities')->where('property_id', $propertyID->id)->select('id')->first();
                // update operation utilities
                $operation_utilities = DB::table('operation_utilities')
                ->where('operation_utilities.id', '=', $operationID->id)
                ->update([
                    'operation_utilities.property_id' => $propertyID->id,
                    'operation_utilities.gas_provider' => $pcVal[1] ? $pcVal[1] : null,
                    'operation_utilities.gas_contract_start_date' => format_date($pcVal[2]),
                    'operation_utilities.gas_contract_end_date' => format_date($pcVal[3]),
                    'operation_utilities.gas_account_number' => $pcVal[4] ? $pcVal[4] : null,
                    'operation_utilities.electric_provider' => $pcVal[5] ? $pcVal[5] : null,
                    'operation_utilities.electric_contract_start_date' => format_date($pcVal[6]),
                    'operation_utilities.electric_contract_end_date' => format_date($pcVal[7]),
                    'operation_utilities.electric_account_number' => $pcVal[8] ? $pcVal[8] : null,
                    'operation_utilities.water_provider' => $pcVal[9] ? $pcVal[9] : null,
                    'operation_utilities.water_account_number' => $pcVal[10] ? $pcVal[10] : null,
                    'operation_utilities.tv_licence' => $pcVal[11] ? $pcVal[11] : null,
                    'operation_utilities.tv_licence_contract_start_date' => format_date($pcVal[12]),
                    'operation_utilities.tv_licence_contract_end_date' => format_date($pcVal[13]),
                    'operation_utilities.broadband_provider' => $pcVal[14] ? $pcVal[14] : null,
                    'operation_utilities.broadband_account_number' => $pcVal[15] ? $pcVal[15] : null,
                    'operation_utilities.insurance_in_place' => 1,
                    'operation_utilities.insurance_provider' => $pcVal[16] ? $pcVal[16] : null,
                    'operation_utilities.insurance_start_date' => format_date($pcVal[17]),
                    'operation_utilities.insurance_end_date' => format_date($pcVal[18]),
                    'operation_utilities.insurance_policy_no' => $pcVal[19] ? $pcVal[19] : null,
                    'operation_utilities.council_account_no' => $pcVal[20] ? $pcVal[20] : null,
                    'operation_utilities.exempt' => $pcVal[21] == '1' ? '1' : '0',
                    'operation_utilities.exemption_date' => format_date($pcVal[22]),
                ]);
            }
        }

        return true;
    }
}
