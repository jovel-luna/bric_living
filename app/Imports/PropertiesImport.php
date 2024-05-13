<?php

namespace App\Imports;

use App\Models\Entity;
use App\Models\Property;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class PropertiesImport implements ToModel, SkipsEmptyRows, WithStartRow
{
    use Importable;

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 4;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function rules(): array
    {
        return [
            'property_phase' => [
                'required',
                'string',
            ],
            'entity' => [
                'required',
                'string',
            ],
            'city' => [
                'required',
                'string',
            ],
            'area' => [
                'required',
                'string',
            ],
            'house_no_or_name' => [
                'required',
                'string',
            ],
            'street' => [
                'required',
                'string',
            ],
            'postcode' => [
                'required',
                'string',
            ],
            'no_bric_beds' => [
                'string',
            ],
            'no_bric_bathrooms' => [
                'string',
            ],
            'purchase_date' => [
                'required',
                'date_format:Y/m/d',
            ],
            'status' => [
                'string',
            ],
        ];
    }

    public function model(array $row)
    {
        if ($row[0] === 'In Development') {
            $status = '4';
        }else{
            switch ($row[9]) {
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


        return new Property([
            'property_phase' => $row[0],
            'entity' => $row[1],
            'city' => $row[2],
            'area' => $row[3],
            'house_no_or_name' => $row[4],
            'street' => $row[5],
            'postcode' => $row[6],
            'no_bric_beds' => strval($row[7]),
            'no_bric_bathrooms' => strval($row[8]),
            'status' => $status,
            'purchase_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10])->format('Y-m-d'),
            'acquisition_status' => $row[11],
            'single_asset_portfolio' => $row[12],
            'portfolio' => $row[13],
            'existing_bedroom_no' => strval($row[14]),
            'stamp_duty' => number_format($row[15], 2, ',', ' '),
            'agent' => $row[16],
            'agent_fee_percentage' => strval($row[17]),
            'agent_fee' => number_format($row[18], 2, ',', ' '),
            'estimated_tpc' => number_format($row[19], 2, ',', ' '),
            'offer_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[20])->format('Y-m-d'),
            'target_completion_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[21])->format('Y-m-d'),
            'completion_date' => $row[22] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[22])->format('Y-m-d') : null,
            'col_status' => $row[23],
            'financing_status' => $row[24],
            'asking_price' => number_format($row[25], 2, ',', ' '),
            'offer_price' => number_format($row[26], 2, ',', ' '),
            'agreed_purchase_price' => number_format($row[27], 2, ',', ' '),
            'difference' => number_format($row[28], 2, ',', ' '),
            'acquisition_cost' => number_format($row[29], 2, ',', ' '),
            'bridge_loan' => $row[30],
            'estimated_period' => strval($row[31]),
            'loan_percentage' => strval($row[32]),
            'estimated_interest' => strval($row[33]),
            'capex_budget' => number_format($row[34], 2, ',', ' '),
            'bric_purchase_yield_percentage' => number_format($row[35], 2, ',', ' '),
            'tpc_bedspace' => number_format($row[36], 2, ',', ' '),
            'purchase_price_bedspace' => number_format($row[37], 2, ',', ' '),
            'bric_y1_proposed_rent_pppw' => strval($row[38]),
            'tenancy_length_weeks' => strval($row[39]),
            'tennure' => $row[40],
            'ground_rent' => $row[41] == 'N/A' || $row[41] == null ? null : number_format($row[41], 2, ',', ' '),
            'ground_rent_due' => $row[42] == 'N/A' || $row[42] == null ? null : \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[42])->format('Y-m-d'),
            'project_start_date' => $row[43] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[43])->format('Y-m-d') : null,
            'projected_completion_date' => $row[44] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[44])->format('Y-m-d') : null,
            'development_status' => $row[45] ? $row[45] : null ,
            'insurance_value' => $row[46] ? number_format($row[46], 2, ',', ' ') : null,
            'insurance_annual_cost' => $row[47] ? number_format($row[47], 2, ',', ' ') : null,
            'insurance_renewal_date' => $row[48],
        ]);
    }
}
