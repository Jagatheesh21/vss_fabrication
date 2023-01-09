<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Type;
use App\Models\ChildPartNumber;
use App\Models\RawMaterial;
use App\Models\Nesting;
use App\Models\PurchaseOrder;
use App\Models\PoMaster;
use App\Models\PurchaseOrderItem;
use App\Models\Supplier;
use App\Models\Uom;
use Auth;
use App\Models\StoreStock;
use App\Http\Requests\StoreStockRMEntryRequest;
use DB;
use Carbon\Carbon;
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
        // $stock = StoreStock::where('purchase_order_id',1);
        // $purchase =  PoMaster::find(1);
        // dd($purchase);
        // dd($stock->sum('inward_quantity'));
        $grn_number = StoreStock::getNextGrnNumber(); 
        $types = Type::where('category_id',1)->whereStatus(1)->get();
        return view('store.store_receive_rm_entry',compact('grn_number','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStockRMEntryRequest $request)
    {
        DB::beginTransaction();
        try {
        $store = new StoreStock;
        $store->grn_number = $request->grn_number;
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
        DB::commit();
        // Purchase Order 
        //return redirect()->route('store.getConfirm', $store->id);
       //return response()->json(['success' => 'Store Stock Added Successfully!','status' => 200]);
       return back()->withSuccess('Store Stock Added Successfully!');            
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
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
        DB::beginTransaction();
        try {
            $store = StoreStock::find($id);
            $types = Type::where('category_id',1)->whereStatus(1)->get();
            $raw_materials = RawMaterial::get();
            $types = Type::where('category_id',1)->whereStatus(1)->get();
            DB::commit();
            return view('store.grn_approval',compact('store','types','raw_materials'));
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return back()->withError($th->getMessage());
        }
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
        try {
            $store = StoreStock::find($id);
            $store->category_id = $request->category_id;
            $store->type_id = $request->type_id;
            $store->raw_material_id = $request->raw_material_id;
            $store->uom_id = $request->uom_id;
            $store->inward_quantity = $request->inward_quantity;
            $store->available_quantity = $request->inward_quantity;
            $store->confirm = 1;
            $store->approved_by = auth()->user()->id;
            $store->approved_date = Carbon::now();
            $store->approved_status = 1;
            $store->update();
            return redirect(route('store_receive.create'))->withSuccess('GRN Confirmed Successfully!');
        } catch (Exception $e) {
            return back()->withError($e->getMessage());
        }
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
        $purchase_order = PoMaster::find($purchase_order_id);
        $supplier = Supplier::find($purchase_order->supplier_id);
        $html = view('store.supplier_details',compact('supplier'))->render();
        return response(['html' => $html]);
    }

    public function getPurchaseOrder(Request $request)
    {
        $purchase_order_id = $request->input('purchase_order_id');
        $purchase_order = PoMaster::find($purchase_order_id);
        $supplier = Supplier::find($purchase_order->supplier_id);
        $test = PoMaster::with(['uom','raw_material','material_uom','supplier'])->find($request->input('purchase_order_id'));
        $type = Type::find($test->raw_material->type_id);
        $store_stock = StoreStock::where('purchase_order_id',$request->input('purchase_order_id'))->sum('issued_quantity');
        $store_material_stock = StoreStock::where('purchase_order_id',$request->input('purchase_order_id'))->sum('issued_material_quantity');
        $available_quantity = ($purchase_order->po_quantity)-$store_stock;
        $available_material = ($purchase_order->material_quantity)-$store_material_stock;
        $unit_material_quantity = $purchase_order->unit_material_quantity;
        return response(['test' => $test,'type' => $type,'supplier'=>$supplier,'available_quantity'=>$available_quantity,'available_material'=>$available_material,'unit_material_quantity'=>$unit_material_quantity]);
        // $html = view('store.supplier_details',compact('supplier'))->render();
        // return response(['html' => $html]);
    }

    public function getRawMaterials(Request $request)
    {
        if($request->type_id)
        {
            $raw_materials = RawMaterial::where('type_id',$request->type_id)->get();
            return json_encode($raw_materials);
        }
    }
    public function getMaterialPurchaseOrder(Request $request)
    {
        if($request->raw_material_id)
        {
            //$purchase_order = PurchaseOrderItem::with('purchase_order','raw_material')->where('raw_material_id',$request->raw_material_id)->GroupBy('purchase_order_id')->get();
            $purchase_order = PoMaster::with('raw_material')->where('raw_material_id',$request->raw_material_id)->get();
            return json_encode($purchase_order);
        }
    }
    public function getConfirm($id)
    {
        $store = StoreStock::find($id);
        $suppliers = Supplier::get();
        $types = Type::where('category_id',1)->whereStatus(1)->get();
        $raw_materials = RawMaterial::get();
        $uoms = Uom::get();
        $purchase_orders = PurchaseOrder::get();
        $types = Type::where('category_id',1)->whereStatus(1)->get();
        DB::commit();
        return view('store.grn_approval',compact('store','types','purchase_orders','raw_materials','suppliers','uoms'));
    }

    public function approval(Request $request)
    {

    }
    public function getChildPartNumber(Request $request)
    {
        $type = Type::find($request->type_id);
        $raw_material_id = RawMaterial::find($request->raw_material_id);
        $child_part_numbers = ChildPartNumber::find($request->type_id);
    }
    
}

