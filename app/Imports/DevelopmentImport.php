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

class DevelopmentImport implements ToModel, SkipsEmptyRows, WithStartRow
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

    public function model(array $row)
    {
        return new Development([
            'pid' => $row[0],
            'existing_stories' => $row[1],
            'bric_stories' => $row[2],
            'project_start_date' => $row[3],
            'projected_completion_date' => $row[4],
            'development_status' => $row[5],
            'pc_company' => $row[6],
            'pc_name' => $row[7],
            'pc_mobile' => $row[8],
            'pc_email' => $row[9],
            'bc_company' => $row[10],
            'bc_name' => $row[11],
            'bc_mobile' => $row[12],
            'bc_email' => $row[13],
            'abestos_survey' => $row[14],
            'rams' => $row[15],
            'coshh' => $row[16],
            'neighbours_notified' => $row[17],
            'overall_budget' => $row[18],
            'actual_spend' => $row[19],
        ]);
    }
}
