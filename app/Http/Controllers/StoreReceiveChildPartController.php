<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Type;
use App\Models\ChildPartNumber;
use App\Models\RawMaterial;
use App\Models\Nesting;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\Uom;
use App\Models\Operation;
use Auth;
use App\Models\StoreStock;
use App\Models\RouteCardTransaction;
use App\Http\Requests\StoreStockRMEntryRequest;
use DB;
use Carbon\Carbon;
use App\Http\Requests\StoreStoreReceiveChildPartRequest;
use App\Http\Requests\UpdateStoreReceiveChildPartRequest;

class StoreReceiveChildPartController extends Controller
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
        $operations = Operation::all();
        $types = Type::where('category_id',1)->get();
        $child_part_numbers = ChildPartNumber::get();
        $route_cards = RouteCardTransaction::where('route_card_type_id',1)->whereNull('closed_date')->get();
        return view('store.store_receive_child_part',compact('operations','child_part_numbers','types','route_cards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStoreReceiveChildPartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreReceiveChildPartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreReceiveChildPart  $storeReceiveChildPart
     * @return \Illuminate\Http\Response
     */
    public function show(StoreReceiveChildPart $storeReceiveChildPart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoreReceiveChildPart  $storeReceiveChildPart
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreReceiveChildPart $storeReceiveChildPart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreReceiveChildPartRequest  $request
     * @param  \App\Models\StoreReceiveChildPart  $storeReceiveChildPart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreReceiveChildPartRequest $request, StoreReceiveChildPart $storeReceiveChildPart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreReceiveChildPart  $storeReceiveChildPart
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreReceiveChildPart $storeReceiveChildPart)
    {
        //
    }
}
