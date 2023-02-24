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
        try {
            $child_part_numbers = $request->input('child_part_number_id');
            $issued_quantity = $request->input('issued_quantity');
            $ok_quantity = $request->input('ok_quantity');
            foreach($child_part_numbers as $key=>$child_part)
            {
                $rc = new RouteCardTransaction;
                $rc->from_operation_id = $request->previous_operation_id;
                $rc->to_operation_id = $request->operation_id;
                $rc->prev_route_card_type_id = $request->previous_route_card_type_id;
                $rc->prev_route_card_number = $request->prev_route_card_id;
                $rc->child_part_number_id = $child_part;
                $rc->ok_quantity = $ok_quantity[$key];
                $rc->ip_address = $request->ip();
                $rc->user_id = auth()->user()->id;
                $rc->save();
            }
            return response()->json('Success', 200);
            //return back()->withSuccess('Route Card Received Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->withError($th->getMessage());
        }
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
    public function getChildPartNumbers(Request $request)
    {
        $route_card_id = $request->route_card_id;
        $child_part_numbers = RouteCardTransaction::with('child_part_number')->where('route_card_number',$route_card_id)->get();
        $child_parts = ChildPartNumber::get();
        $route_card_type = RouteCardTransaction::select('route_card_type_id')->where('route_card_number',$route_card_id)->GroupBy('route_card_number')->first();
        $html = view('store.receive_child_parts',compact('child_part_numbers','child_parts'))->render();
        return response(['html'=>$html,'route_card_type'=>$route_card_type->route_card_type_id]);
        
    }
    public function getRouteCards(Request $request)
    {
        $operation_id = $request->operation_id;
        $route_cards = RouteCardTransaction::where('to_operation_id',$operation_id)->where('closed_date',NULL)->OrderBy('created_at')->get();
        $html = "<option value=''>Select Previous Route Card</option>";
        foreach($route_cards as $route_card)
        {
            $html.="<option value='$route_card->route_card_number'>$route_card->route_card_number</option>";
        }
        return $html;
    }
}
