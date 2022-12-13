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
        $purchase_orders = PurchaseOrder::whereStatus(1)->get();
        return view('store.store_receive_rm_entry',compact('categories','types','raw_materials','uoms','purchase_orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStockRMEntryRequest $request)
    {
        try {
        $store = new StoreStock;
        $store->category_id = $request->category_id;
        $store->type_id = $request->type_id;
        $store->raw_material_id = $request->raw_material_id;
        $store->uom_id = $request->uom_id;
        $store->purchase_order_id = $request->purchase_order_id;
        $store->supplier_id = $request->supplier_id;
        $store->invoice_number = $request->invoice_number;
        $store->inward_quantity = $request->inward_quantity;
        $store->checked_quantity = 0;
        $store->available_quantity = 0;
        $store->created_by = auth()->user()->id;            
        $store->updated_by = auth()->user()->id;
        $store->save();
        // Purchase Order
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
    public function getSupplier(Request $request)
    {
        $purchase_order_id = $request->input('purchase_order_id');
        $purchase_order = PurchaseOrder::find($purchase_order_id);
        $supplier = Supplier::find($purchase_order->supplier_id);
        $html = view('store.supplier_details',compact('supplier'))->render();
        return response(['html' => $html]);
    }

    public function getPurchaseOrder(Request $request)
    {
        $purchase_order_id = $request->input('purchase_order_id');
        $purchase_order = PurchaseOrder::find($purchase_order_id);
        $supplier = Supplier::find($purchase_order->supplier_id);
        $test = PurchaseOrder::with(['supplier','uom','raw_material'])
        ->where('id',$request->input('purchase_order_id'))
        ->first();
        $type = Type::find($test->raw_material->type_id);
        StoreStock::where('purchase_order_id');
        return response(['test' => $test,'type' => $type]);
        // $html = view('store.supplier_details',compact('supplier'))->render();
        // return response(['html' => $html]);
    }
}
