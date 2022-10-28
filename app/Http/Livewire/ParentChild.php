<?php

namespace App\Http\Livewire;

use App\Models\Type;
use App\Models\Category;
use App\Models\ChildPartNumber;
use App\Models\Uom;
use Livewire\Component;
use App\Http\Requests\StorePartMasterRequest;

class ParentChild extends Component
{
    public $categories;
    public $childparts;
    public $types;
    public $uoms;

    public $name;
    public $category;
    public $child_part;
    public $type;
    public $uom;


    public function mount()
    {
        $this->categories = Category::all();
        $this->child_parts = ChildPartNumber::all();
        $this->types = collect();
        $this->uoms = Uom::all();
    }
    public function addRequestDetail()
{
 $this->dispatchBrowserEvent('reApplySelect2');
}
    public function render()
    {
        return view('livewire.bootstrap.parent-child', [
            'categories' => Category::latest()->get(),'child_parts' => ChildPartNumber::whereStatus(1)->get()
        ]);
    }
    public function updatedCategory($value)
    {
        $this->types = Type::where('category_id', $value)->get();
        $this->type = $this->types->first()->id ?? null;
    }


}
