<?php

namespace App\Exports;

use App\Models\Operation;
use Maatwebsite\Excel\Concerns\FromCollection;

class OperationExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Operation::all();
    }
}
