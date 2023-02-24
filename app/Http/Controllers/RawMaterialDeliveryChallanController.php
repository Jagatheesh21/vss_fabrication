<?php

namespace App\Http\Controllers;

use App\Models\RawMaterialDeliveryChallan;
use App\Models\StoreStock;
use App\Models\ChildPartNumber;
use App\Models\RawMaterial;
use App\Http\Requests\StoreRawMaterialDeliverChallanRequest;
use App\Http\Requests\UpdateRawMaterialDeliverChallanRequest;
use Illuminate\Http\Request;

class RawMaterialDeliveryChallanController extends Controller
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
    public function create()
    {
        $dc_number = RawMaterialDeliveryChallan::getNextDcNumber();
        $grn_numbers = StoreStock::where('type_id',2)->where('checked_quantity','>',0)->where('approved_by','>',0)->get();
        $part_numbers = ChildPartNumber::where('part_type_id',2)->get();
        $raw_materials = RawMaterial::where('type_id',2)->get();
        return view('raw_material_delivery_challan.create',compact('dc_number','grn_numbers','part_numbers','raw_materials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRawMaterialDeliverChallanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRawMaterialDeliverChallanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RawMaterialDeliverChallan  $rawMaterialDeliverChallan
     * @return \Illuminate\Http\Response
     */
    public function show(RawMaterialDeliverChallan $rawMaterialDeliverChallan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RawMaterialDeliverChallan  $rawMaterialDeliverChallan
     * @return \Illuminate\Http\Response
     */
    public function edit(RawMaterialDeliverChallan $rawMaterialDeliverChallan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRawMaterialDeliverChallanRequest  $request
     * @param  \App\Models\RawMaterialDeliverChallan  $rawMaterialDeliverChallan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRawMaterialDeliverChallanRequest $request, RawMaterialDeliverChallan $rawMaterialDeliverChallan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RawMaterialDeliverChallan  $rawMaterialDeliverChallan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawMaterialDeliverChallan $rawMaterialDeliverChallan)
    {
        //
    }
    public function get_grns(Request $request)
    {
        $raw_material_id = $request->raw_material_id;
        $grn_numbers = StoreStock::where('type_id',2)->where('raw_material_id',$raw_material_id)->where('checked_quantity','>',0)->where('approved_by','>',0)->get();
        $html = "<option value=''>Select GRN</option>";
        foreach($grn_numbers as $grn_number)
        {
            $html.="<option value='".$grn_number->id."'>".$grn_number->grn_number."</option>";
        }
        return $html;
    }
    public function grn_details(Request $request)
    {
        $grn_number_id = $request->grn_number_id;
        $grn_details = StoreStock::find($grn_number_id);
        $total_quantity = $grn_details->inward_quantity;
        $issued_quantity = RawMaterialDeliveryChallan::where('grn_id',$grn_number_id)->sum('issued_quantity');
        $available_quantity = $total_quantity-$issued_quantity;
        //return response(['total_qu']); 
    }
}
