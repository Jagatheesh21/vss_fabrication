<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Type;
use App\Models\RawMaterial as Material;
use App\Models\ChildPartNumber;
use App\Models\Nesting;
use App\Models\NestingSequence;
use App\Models\PartMaster;
use App\Models\ChildPartBom;

class RawMaterial extends Component
{
    public $types;
    public $raw_materials;
    public $child_part_numbers;
    public $nestings;
    public $nesting_types;
    public $part_masters;
    public $bom_number;

    public $name;
    public $type;
    public $raw_material;
    public $child_part_number;
    public $nesting;
    public $nesting_type;
    public $part_master;

    public function mount()
    {
        $this->types = Type::where('status',1)->get();
        $this->raw_materials = collect();
        $this->child_part_numbers = collect() ;
        $this->nestings = Nesting::all();
        $this->nesting_types = collect();
        $this->part_masters = collect();
        $this->bom_number = ChildPartBom::getNextBomNumber();
    }

    public function render()
    {
        return view('livewire.raw-material',[
            'types' => Type::whereStatus(1)->where('category_id',1)->get(),
            'nestings' => Nesting::all(),
            'bom_number' => ChildPartBom::getNextBomNumber()
        ]);
    }

    public function updatedType($value)
    {
        $this->raw_materials = Material::where('type_id', $value)->get();
        $this->raw_material = $this->raw_materials->first()->id ?? null;   
    }

    public function updatedNesting($value)
    {
        $this->nesting_types = NestingSequence::where('nesting_id',$value)->get();
        $this->child_part_numbers = ChildPartNumber::where('status',1)->get();
    }


}
