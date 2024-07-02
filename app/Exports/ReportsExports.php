<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportsExports implements FromCollection
{
    private $query = null;
    function __construct($query)
    {
        $this->query = $query;
    }

    public function collection()
    {
        return $this->query;
    }
}