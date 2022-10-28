<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ChildPartNumber;
use App\Models\PartMaster;

class ChildPartMaster extends Component
{
    public $child_part_numbers;
    public $types;
    public $child_parts;
    public $cstegory;



    public function render()
    {
        return view('livewire.child-part-master');
    }
}
