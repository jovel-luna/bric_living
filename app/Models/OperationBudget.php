<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OperationBudget extends Model
{
    use HasFactory;

    public function import($data, $entitiy){
        foreach ($data[0] as $pck => $pcVal) {            
            $propertyID = DB::table('properties')->where('ref_no', $pcVal[0])->select('properties.id')->first();
            if ($propertyID) {
                $operationBudgetID = DB::table('operation_budgets')->where('property_id', $propertyID->id)->select('id')->first();
                // update operation budgets
                if ($operationBudgetID) {
                    $operation_budgets = DB::table('operation_budgets')
                    ->where('operation_budgets.id', '=', $operationBudgetID->id)
                    ->update([
                        'operation_budgets.property_id' => $propertyID->id,
                        'operation_budgets.budget_year' => $pcVal[1] ? $pcVal[1] : null,
                        'operation_budgets.hmo_licence_fee' => $pcVal[2] ? number_format($pcVal[2]) : null,
                        'operation_budgets.hmo_licence_period' => $pcVal[3] ? number_format($pcVal[3]) : null,
                        'operation_budgets.hmo_fee_per_year' => $pcVal[4] ? number_format($pcVal[4]) : null,
                        'operation_budgets.maintenance_property_year' => $pcVal[5] ? number_format($pcVal[5]) : null,
                        'operation_budgets.maintenance_bed_year' => $pcVal[6] ? number_format($pcVal[6]) : null,
                        'operation_budgets.gas_property_year' => $pcVal[7] ? number_format($pcVal[7]) : null,
                        'operation_budgets.gas_bed_year' => $pcVal[8] ? number_format($pcVal[8]) : null,
                        'operation_budgets.electric_property_year' => $pcVal[9] ? number_format($pcVal[9]) : null,
                        'operation_budgets.electric_bed_year' => $pcVal[10] ? number_format($pcVal[10]) : null,
                        'operation_budgets.water_property_year' => $pcVal[11] ? number_format($pcVal[11]) : null,
                        'operation_budgets.water_bed_year' => $pcVal[12] ? number_format($pcVal[12]) : null,
                        'operation_budgets.internet_property_year' => $pcVal[13] ? number_format($pcVal[13]) : null,
                        'operation_budgets.internet_bed_year' => $pcVal[14] ? number_format($pcVal[14]) : null,
                        'operation_budgets.tv_licence_per_house' => $pcVal[15] ? number_format($pcVal[15]) : null,
                        'operation_budgets.property_insurance_annual_cost' => $pcVal[16] ? number_format($pcVal[16]) : null,
                        'operation_budgets.total_opex_budget' => $pcVal[17] ? number_format($pcVal[17]) : null,
                    ]);
                }else{
                    $budget = new OperationBudget();
                    $budget->property_id = $propertyID->id;
                    $budget->budget_year = $pcVal[1] ? $pcVal[1] : null;
                    $budget->hmo_licence_fee = $pcVal[2] ? number_format($pcVal[2]) : null;
                    $budget->hmo_licence_period = $pcVal[3] ? number_format($pcVal[3]) : null;
                    $budget->hmo_fee_per_year = $pcVal[4] ? number_format($pcVal[4]) : null;
                    $budget->maintenance_property_year = $pcVal[5] ? number_format($pcVal[5]) : null;
                    $budget->maintenance_bed_year = $pcVal[6] ? number_format($pcVal[6]) : null;
                    $budget->gas_property_year = $pcVal[7] ? number_format($pcVal[7]) : null;
                    $budget->gas_bed_year = $pcVal[8] ? number_format($pcVal[8]) : null;
                    $budget->electric_property_year = $pcVal[9] ? number_format($pcVal[9]) : null;
                    $budget->electric_bed_year = $pcVal[10] ? number_format($pcVal[10]) : null;
                    $budget->water_property_year = $pcVal[11] ? number_format($pcVal[11]) : null;
                    $budget->water_bed_year = $pcVal[12] ? number_format($pcVal[12]) : null;
                    $budget->internet_property_year = $pcVal[13] ? number_format($pcVal[13]) : null;
                    $budget->internet_bed_year = $pcVal[14] ? number_format($pcVal[14]) : null;
                    $budget->tv_licence_per_house = $pcVal[15] ? number_format($pcVal[15]) : null;
                    $budget->property_insurance_annual_cost = $pcVal[16] ? number_format($pcVal[16]) : null;
                    $budget->total_opex_budget = $pcVal[17] ? number_format($pcVal[17]) : null;
                    $budget->save();
                }
            }

            //         $expenditure = new OperationExpenditure();
            //         $expenditure->property_id = $propertyID->id;
            //         $expenditure->expenditure_year = $pcVal[40] ? $pcVal[40] : null;
            //         $expenditure->hmo_licence_fee = $pcVal[41] ? number_format($pcVal[41]) : null;
            //         $expenditure->hmo_licence_period = $pcVal[42] ? number_format($pcVal[42]) : null;
            //         $expenditure->hmo_fee_per_year = $pcVal[43] ? number_format($pcVal[43]) : null;
            //         $expenditure->maintenance_property_year = $pcVal[44] ? number_format($pcVal[44]) : null;
            //         $expenditure->maintenance_bed_year = $pcVal[45] ? number_format($pcVal[45]) : null;
            //         $expenditure->gas_property_year = $pcVal[46] ? number_format($pcVal[46]) : null;
            //         $expenditure->gas_bed_year = $pcVal[47] ? number_format($pcVal[47]) : null;
            //         $expenditure->electric_property_year = $pcVal[48] ? number_format($pcVal[48]) : null;
            //         $expenditure->electric_bed_year = $pcVal[49] ? number_format($pcVal[49]) : null;
            //         $expenditure->water_property_year = $pcVal[50] ? number_format($pcVal[50]) : null;
            //         $expenditure->water_bed_year = $pcVal[51] ? number_format($pcVal[51]) : null;
            //         $expenditure->internet_property_year = $pcVal[52] ? number_format($pcVal[52]) : null;
            //         $expenditure->internet_bed_year = $pcVal[53] ? number_format($pcVal[53]) : null;
            //         $expenditure->tv_licence_per_house = $pcVal[54] ? number_format($pcVal[54]) : null;
            //         $expenditure->property_insurance_annual_cost = $pcVal[55] ? number_format($pcVal[55]) : null;
            //         $expenditure->total_opex_budget = $pcVal[56] ? number_format($pcVal[56]) : null;
            //         $expenditure->save();
        }

        return true;
    }
}
