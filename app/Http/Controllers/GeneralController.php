<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Type;
use App\Models\RawMaterial;
use App\Models\ChildPartNumber;
use App\Models\PartMaster;
use App\Models\ChildPartBom;
use App\Models\Uom;
use App\Models\OperationType;
use App\Models\Operation;
use App\Models\Nesting;
use App\Models\NestingSequence;
use App\Models\StoreTranscation;
use App\Models\StoreStock;
use App\Models\Supplier;
use App\Models\PurchaseOrder;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    // public function __construct()
    // {

    // }

    public function getTypes(Request $request)
    {
        $types = Type::where('status',1);
        if($request->category_id)
        {
            $category_id = $request->category_id;
            $types = $types->where('category_id',$category_id)->where('id','!=',2);
        }
        $types = $types->get();
        $html = view('general.types',compact('types'))->render();
        return response(['html' => $html]);
    }
    public function getMaterials(Request $request)
    {
        $materials = RawMaterial::where('status',1);
        if($request->type_id)
        {
            $type_id = $request->type_id;
            $materials->where('type_id',$type_id);
        }
        $materials = $materials->get();
        $html = view('general.raw_materials',compact('materials'))->render();
        return response(['html' => $html]);
    }
    public function getSuppliers(Request $request)
    {
        if($request->purchase_order_id)
        {
            $suppliers = Supplier::where('status',1)->get();
            $purchase_order_id = $request->purchase_order_id;
            $purchase_order = PurchaseOrder::find($purchase_order_id);
            $supplier = Supplier::find($purchase_order->supplier_id);
            $html = view('general.suppliers',compact('supplier','suppliers'))->render();
            return response(['html' => $html]);
        }
        
    }  
    public function getGrns(Request $request)
    {
        if($request->raw_material_id)
        {
            $raw_material_id = $request->raw_material_id;

            $grn_numbers = StoreStock::where('raw_material_id',$raw_material_id)->get();
            return json_encode($grn_numbers);
        }
    }
    public function getNestings(Request $request)
    {
        if($request->raw_material_id)
        {
            $raw_material_id = $request->raw_material_id;
            $nestings = ChildPartBom::with('nesting')->where('raw_material_id',$raw_material_id)->GroupBy('nesting_id')->get();
            return json_encode($nestings);
        }
    }  
    public function getNestingList(Request $request)
    {
        if($request->nesting_id)
        {
            $nesting_id = $request->nesting_id;
            $nesting_types = Type::where('category_id',2)->get();
            $raw_material_id = $request->raw_material_id;
            $nesting_sequences = ChildPartBom::with(['nesting_type','child_part_number'])->where('nesting_id',$nesting_id)->where('raw_material_id',$raw_material_id)->GroupBy('nesting_type_id')->get();
            $html = view('general.nesting_list',compact('nesting_sequences','nesting_types'))->render();
            return response(['html' => $html]);
        }
    }
    public function getNestingSequences(Request $request)
    {
        if($request->nesting_id)
        {
            $nesting_id = $request->nesting_id;
            $raw_material_id = $request->raw_material_id;
            $nesting_sequences = ChildPartBom::with('nesting_type')->where('nesting_id',$nesting_id)->where('raw_material_id',$raw_material_id)->GroupBy('nesting_type_id')->get();
            $html = view('general.nesting_sequences',compact('nesting_sequences'))->render();
            return response(['html' => $html]);
        }
    }
    public function getNestingPartNumbers(Request $request)
    {
        if($request->nesting_id)
        {
            $nesting_id = $request->nesting_id;
            $raw_material_id = $request->raw_material_id;
            $nesting_type_id = $request->nesting_type_id;
            $child_part_numbers = ChildPartBom::with('child_part_number')->where('nesting_id',$nesting_id)->where('raw_material_id',$raw_material_id)->where('nesting_type_id',$nesting_type_id)->get();
            $html = view('general.nesting_part_numbers',compact('child_part_numbers'))->render();
            return response(['html' => $html]);
        }
    }      
    public function getAvailableQuantity(Request $request)
    {
        if($request->store_stock_id)
        {
            $store_stock_id = $request->store_stock_id;
            $purchase = StoreStock::find($store_stock_id); 
            return response(['available_quantity'=>$purchase->available_quantity,'unit_weight'=>$purchase->unit_material_quantity]);
            // $nestings = ChildPartBom::where('raw_material_id',$purchase->raw_material_id)->GroupBy('nesting_id')->get();
            // $html = view('store.nesting_list',compact('nestings'))->render();
            // return response(['purchase'=>$purchase,'html' =>$html]);
            
        }
    }
}
