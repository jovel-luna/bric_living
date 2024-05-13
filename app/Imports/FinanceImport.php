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

class FinanceImport implements ToModel, SkipsEmptyRows, WithStartRow
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
        return $row;
    }
}
