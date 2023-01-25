<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreIssueEntryRequest;
use App\Models\StoreStock;
use App\Models\ChildPartNumber;
use App\Models\Category;
use App\Models\ChildPartBom;
use App\Models\Operation;
use App\Models\Type;
use App\Models\RawMaterial;
use App\Models\Nesting;
use App\Models\NestingSequence;
use App\Models\SheetNesting;
use App\Models\StoreTransaction;
use App\Models\RouteCardTransaction;
use App\Models\PurchaseOrder;
use Auth;

class StoreIssueEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $child_part_numbers = ChildPartNumber::whereStatus(1)->get();
        $raw_materials = RawMaterial::whereStatus(1)->get();
        $route_card_number = RouteCardTransaction::getNextRouteCardNumber(1);
        $nestings = SheetNesting::all();
        $types = Type::where('category_id',1)->where('id','!=',2)->get();
        $purchase_orders = PurchaseOrder::where('status',1)->get();

        return view('store.store_issue_rm_entry',compact('child_part_numbers','types','raw_materials','route_card_number','nestings','purchase_orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIssueEntryRequest $request)
    {

       dd($request->all());
        try {
            //StoreTransaction::create($request->validated());
            $nesting_types = $request->input('nesting_type_id');
            $child_part_numbers = $request->input('child_part_number_id');
            $unit_weights = $request->input('unit_weight');
            $useage_weights = $request->input('useage_weight');
            $estimate_quantities = $request->input('estimate_quantity');
            $nesting_types = $request->input('nesting_type_id');
            foreach($nesting_types as $key=>$nesting_type)
            {
                $rc = new RouteCardTransaction;
                $rc->route_card_type_id = $request->route_card_type_id;
                $rc->route_card_number = $request->route_card_number;
                $rc->issued_raw_material_quantity = $useage_weights[$key];
                $rc->issued_quantity = $estimate_quantities[$key];
                $rc->ip_address = $request->ip();
                $rc->user_id = auth()->user()->id;
                $rc->raw_material_id = $request->input('raw_material_id');
                $rc->child_part_number_id = $child_part_numbers[$key];
                $rc->save();
            }
            return back()->withSuccess('Route Card Generated Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->withError($th->getMessage());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getChildPartNumbers(Request $request)
    {
        $raw_material_id = $request->raw_material_id;
        $nesting_id = $request->nesting_id;
        $nesting_type_id = $request->nesting_type_id;
        $bom_child_part_numbers = ChildPartBom::select('child_part_number_id')->where('raw_material_id',$raw_material_id)->where('nesting_id',$nesting_id)->where('nesting_type_id',$nesting_type_id)->get();
        $part_numbers = ChildPartNumber:: select ('*')
        ->whereIn('id', $bom_child_part_numbers)
        ->get();
        return json_encode($part_numbers);
    }
    public function getDcIssuance()
    {
        $stocking_points = Operation::all();
        return view('store.dc_issuance',compact('stocking_points'));
    }
    public function getNestingQuantity(Request $request)
    {
        $raw_material_id = $request->raw_material_id;
        $nesting_id = $request->nesting_id;
        $nesting_type_id = $request->nesting_type_id;
        $child_part_number_id = $request->child_part_number_id;
        $bom = ChildPartBom::select('quantity')->where('raw_material_id',$raw_material_id)->where('nesting_id',$nesting_id)->where('nesting_type_id',$nesting_type_id)->where('child_part_number_id',$child_part_number_id)->first();
        return $bom->quantity;
    }
    public function getSheetNestings(Request $request)
    {
        $raw_material_id = $request->raw_material_id;
        $nestings = SheetNesting::where('raw_material_id',$raw_material_id)->GroupBy('nesting_number')->get();
        return json_encode($nestings);
    }
    public function getSheetNestingLists(Request $request)
    {
        $nesting_number = $request->nesting_id;
        $nestings = SheetNesting::where('nesting_number',$nesting_number)->get();
        $types = Type::where('category_id',2)->where('status',1)->get();
        $child_part_numbers = ChildPartNumber::where('status',1)->get();
        return $html = view("store.sheet_nesting_list",compact('nestings','types','child_part_numbers'))->render();
    }
}

