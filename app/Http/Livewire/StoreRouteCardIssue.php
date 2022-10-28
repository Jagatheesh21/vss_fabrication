<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\ChildPartNumber;
use App\Models\RawMaterial;
use App\Models\StoreStock;
use App\Models\RouteCardType;
use App\Models\StoreTransaction;
use App\Models\Uom;
use App\Models\Category;
use App\Models\Type;

class StoreRouteCardIssue extends Component
{
    public $types;
    public $child_part_numbers;
    public $raw_materials;
    public $uoms;

    public $name;
    public $child_part_number;
    public $raw_material;
    public $uom;
    public $uom_id;
    public $route_card_type;
    public $route_card_number;
    public $stock;
    public $category;
    public $type;

    public function mount()
    {
        $this->raw_materials = collect();
        $this->child_part_numbers = ChildPartNumber::all();
        $this->types = Type::where('category_id',1)->where('status',1)->get();
        $this->uoms = Uom::all();
        $this->stock = 0;
        $this->uom_id=null;
        $this->route_card_number = StoreTransaction::getNextRouteCardNumber();
        $this->category=Category::find(1);
    }

    public function render()
    {
        return view('livewire.store-route-card-issue',[
            'child_part_numbers' => ChildPartNumber::whereStatus(1)->get(),
            'category' => Category::find(1),
            'types' => Type::where('category_id',1)->where('status',1)->get(),
            'route_card_number' => StoreTransaction::getNextRouteCardNumber()
        ]);
    }
    public function updatedType($value)
    {
        $this->raw_materials = RawMaterial::where('type_id',$value)->get();
       // $this->raw_material = $this->raw_materials->first()->id ?? null;
       
    }
    public function updatedRawMaterial($value)
    {
        $this->stock = StoreStock::where('raw_material_id',$value)->where('status',1)->sum('checked_quantity');
        $this->uom = StoreStock::select('uom_id')->where('raw_material_id',$value)->where('status',1)->get();
        $this->uom_id = $this->uom->first()->uom_id ?? null;
    }
    
}
