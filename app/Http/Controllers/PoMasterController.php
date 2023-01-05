<?php

namespace App\Http\Controllers;

use App\Models\PoMaster;
use App\Models\Supplier;
use App\Models\Type;
use App\Models\RawMaterial;
use App\Models\Uom;
use DB;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StorePoMasterRequest;
use App\Http\Requests\UpdatePoMasterRequest;

class PoMasterController extends Controller
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
        $lastOrder = PoMaster::orderBy('created_at','desc')->first();
        if ( ! $lastOrder )
        {
            $number = 0;
            $po_number = 'PO'.date('y'). sprintf('%05d', intval($number) + 1);
        }else{
            $number = substr($lastOrder->rm_po_number,4);
            $po_number = 'PO'.date('y'). sprintf('%05d', intval($number) + 1);
        }
        $suppliers = Supplier::all();
        $types = Type::where('category_id',1)->get();
        $raw_materials = RawMaterial::where('category_id',1)->get();
        $uoms = Uom::all();
        return view('po_master.create',compact('suppliers','types','raw_materials','po_number','uoms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePoMasterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePoMasterRequest $request)
    {
        try {
            PoMaster::create($request->validated());
            return back()->withSuccess('PO Master Added Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->withError($th->getMessage());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PoMaster  $poMaster
     * @return \Illuminate\Http\Response
     */
    public function show(PoMaster $poMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PoMaster  $poMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(PoMaster $poMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePoMasterRequest  $request
     * @param  \App\Models\PoMaster  $poMaster
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePoMasterRequest $request, PoMaster $poMaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PoMaster  $poMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(PoMaster $poMaster)
    {
        //
    }
}
