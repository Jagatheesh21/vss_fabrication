<?php

namespace App\Exports;

use App\Models\ChildPartNumber;
use Maatwebsite\Excel\Concerns\FromCollection;

class ChildPartNumberExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ChildPartNumber::select('name','description')->get();
    }
}
