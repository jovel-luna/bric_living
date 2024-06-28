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
use DateTime;
use Illuminate\Support\Facades\Log;

class EntitiesImport implements ToModel, SkipsEmptyRows, WithStartRow
{
    use Importable;
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }


    
    public function rules(): array
    {
        return [
            'company_registration_number' => [
                'required',
                'string',
            ],
            'entity' => [
                'required',
                'string',
            ],
            'registered_address' => [
                'required',
                'string',
            ],
            'entity_date_created' => [
                'required',
                'string',
            ],
            'statement_due_date' => [
                'string',
            ],
            'financial_year_start_date' => [
                'required',
                'string',
            ],
            'financial_year_end_date' => [
                'required',
                'string',
            ],
            'no_of_properties' => [
                'string',
            ],
            'no_of_beds' => [
                'string',
            ],
            'pipeline' => [
                'string',
            ],
            'current_rent_role' => [
                'string',
            ],
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Entity([
            'company_registration_number' => $row[0],
            'entity' => $row[1],
            'registered_address' => $row[2],
            'entity_date_created' => $row[3],
            'statement_due_date' => $row[4],
            'financial_year_start_date' => $row[5],
            'financial_year_end_date' => $row[6],
            'no_of_properties' => $row[7],
            'no_of_beds' => $row[8],
            'pipeline' => $row[9],
            'current_rent_role' => $row[10],
        ]);
    }
}
