<?php

namespace App\Exports;

use App\Models\ChildPartNumber;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ChildPartNumberExport implements FromCollection, WithMapping, WithHeadings
{
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ChildPartNumber::with('part_type')->get();
    }
    public function map($child_part_number) : array {
        return [
            $child_part_number->id,
            $child_part_number->part_type->name,
            $child_part_number->name,
        ] ;
 
 
    }
    public function headings() : array {
        return [
           '#',
           'Part Type',
           'Part Number',
        ] ;
    }
}
