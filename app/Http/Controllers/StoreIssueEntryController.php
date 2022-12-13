<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreIssueEntryRequest;
use App\Models\StoreStock;
use App\Models\ChildPartNumber;
use App\Models\Category;
use App\Models\Type;
use App\Models\RawMaterial;
use App\Models\Nesting;
use App\Models\NestingSequence;
use App\Models\StoreTransaction;
use App\Models\RouteCardTransaction;
use App\Models\PurchaseOrder;

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
        $category = Category::find(1);
        $types = Type::where('category_id',1)->where('status',1)->get();
        $route_card_number = StoreTransaction::getNextRouteCardNumber();
        $nestings = Nesting::where('status',1)->get();
        $purchase_orders = PurchaseOrder::where('status',1)->get();

        return view('store.store_issue_rm_entry',compact('child_part_numbers','category','types','route_card_number','nestings','purchase_orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIssueEntryRequest $request)
    {
       
        try {
            //StoreTransaction::create($request->validated());
            $child_part_numbers = $request->input('child_part_number_id');
            if($child_part_numbers->count()>0)
            {
                dd($child_part_numbers->count());
            }
            $rc = new RouteCardTransaction;
            $rc->ip_address = $request->ip();
            $rc->raw_material_id = $request->input('raw_material_id');

            $rc->child_part_number_id = $request->input('child_part_number_id');
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
}
