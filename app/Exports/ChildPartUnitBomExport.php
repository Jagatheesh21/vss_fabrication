<?php

namespace App\Exports;

use App\Models\ChildPartNumber;
use App\Models\ChildPartUnitBom;
use App\Models\Uom;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ChildPartUnitBomExport implements FromCollection, WithMapping, WithHeadings
{
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ChildPartUnitBom::with('child_part_number','uom')->get();
    }
    public function map($child_part_unit) : array {
        return [
            $child_part_unit->id,
            $child_part_unit->child_part_number->name,
            $child_part_unit->bom,
            $child_part_unit->uom->name,
        ] ;
 
 
    }
    public function headings() : array {
        return [
           '#',
           'Child Part Number',
           'Bom',
           'Uom',
        ] ;
    }
}
