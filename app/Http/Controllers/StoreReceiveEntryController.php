<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Type;
use App\Models\ChildPartNumber;
use App\Models\RawMaterial;
use App\Models\Nesting;
use App\Models\Uom;
use Auth;
use App\Models\StoreStock;
use App\Http\Requests\StoreStockRMEntryRequest;

class StoreReceiveEntryController extends Controller
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
        $categories = Category::whereStatus(1)->get();
        $types = Type::where('category_id',1)->whereStatus(1)->get();
        $raw_materials = RawMaterial::whereStatus(1)->get();
        $uoms = Uom::whereStatus(1)->get();
        return view('store.store_receive_rm_entry',compact('categories','types','raw_materials','uoms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStockRMEntryRequest $request)
    {
        //dd($request->all());
        try {
        $store = new StoreStock;
        $store->category_id = $request->category_id;
        $store->type_id = $request->type_id;
        $store->raw_material_id = $request->raw_material_id;
        $store->uom_id = $request->uom_id;
        $store->inward_quantity = $request->inward_quantity;
        $store->created_by = auth()->user()->id;            
        $store->updated_by = auth()->user()->id;
        $store->save();
        return back()->withSuccess('Store Stock Added Successfully!');            
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
}
