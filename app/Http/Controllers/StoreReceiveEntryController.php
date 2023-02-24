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
use App\Models\StoreTransaction;
use App\Http\Requests\StoreStockRMEntryRequest;
use App\Http\Requests\UpdateStoreReceiveRequest;
use DB;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
class StoreReceiveEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = StoreStock::with(['raw_material','uom','material_uom'])->latest()->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('status', function($data){
                            if(($data->approved_status)==1){
                                return '<button class="btn btn-sm btn-success text-white">Approved</button>';
                             }else{
                                return '<button class="btn btn-sm btn-danger text-white">Pending</button>';
                            }
                             })
                        
                        ->addColumn('action', function($row){  
                            $btn='';     
                            if(auth()->user()->id==4 && $row->approved_status==0){
                               $btn = '<a href="'.route('store_receive.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editMaterialType">Edit</a>';        
                            }
                            if(auth()->user()->id==4 && $row->approved_status==1){
                                $btn = '<a href="'.route('store_receive.download',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Download" class="edit btn btn-primary btn-sm DownloadReport">Download</a>';        
                             }
                               return $btn;
                        })
                        
                        ->rawColumns(['action','status'])
                        ->make(true);
                    }
                    return view('store.store_transactions');
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
       // DB::beginTransaction();
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
        $store->inward_material_quantity = $request->inward_material_quantity;
        $store->unit_material_quantity = $request->unit_material_quantity;
        $store->material_uom_id = $request->material_uom_id;
        $store->checked_quantity = 0;
        $store->available_quantity = 0;
        $store->created_by = auth()->user()->id;            
        $store->updated_by = auth()->user()->id;
        $store->save();
        return back()->withSuccess('Store Stock Added Successfully!');
        //DB::commit();
                   
        } catch (\Throwable $th) {
            //throw $th;
           // DB::rollback();
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
            $suppliers = Supplier::where('status',1)->get();
            $uoms = Uom::where('status',1)->get();
            DB::commit();
            return view('store.grn_approval',compact('store','types','raw_materials','suppliers','uoms'));
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
    public function update(UpdateStoreReceiveRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $filePath = public_path('inspection_report');
                if (!is_dir($filePath))
                {
                mkdir($filePath, 0755, true);
                } 
            $store = StoreStock::find($id);
            $store->approved_by = auth()->user()->id;
            $store->approved_date = Carbon::now();
            $store->approved_status = 1;
            $store->checked_quantity = $request->ok_material_quantity;
            $store->rejection_quantity = $request->reject_material_quantity;
            $store->available_quantity = ($request->ok_material_quantity)-($request->reject_material_quantity);
            $store->available_stock_quantity = (($request->ok_material_quantity)-($request->reject_material_quantity))*($store->unit_material_quantity);
            if($file = $request->file('inspection_report')) {
                $fileName = $file->getClientOriginalName();
                $fileName = $filePath .'/'. $fileName;
                $file->move($filePath,$fileName);
                $store->inspection_report = $fileName;
            }
            $store->remarks = $request->remarks??null;
            
            $store->update();
            DB::commit();
            return redirect(route('store_receive.index'))->withSuccess('GRN Approved Successfully!');
        } catch (Exception $e) {
            DB::rollback();
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
        $raw_material_id = $request->input('raw_material_id');
        $purchase_order = PurchaseOrder::with('supplier')->find($purchase_order_id);
        $total_quantity = PurchaseOrderItem::with('purchase_order')->where('raw_material_id',$raw_material_id)->where('purchase_order_id',$purchase_order_id)->GroupBy('raw_material_id')->sum('quantity');
        $used_quantity = StoreStock::where('raw_material_id',$raw_material_id)->where('purchase_order_id',$purchase_order_id)->sum('inward_quantity')??0;
        $avaialble_quantity = round($total_quantity-$used_quantity,2);
        $material = RawMaterial::find($raw_material_id);
        $unit_weight = $material->unit_weight;
        $available_material_quantity = round($avaialble_quantity/$unit_weight,2);
        return response(['purchase_order'=>$purchase_order,'purchase_quantity'=>$total_quantity,'used_quantity'=>$used_quantity,'available_quantity'=>$avaialble_quantity,'unit_weight'=>$unit_weight,'available_material_quantity'=>$available_material_quantity]);

        // dd($purchase_order->purchase_order_items);
        // $supplier = Supplier::find($purchase_order->supplier_id);
        // $test = PurchaseOrder::with(['supplier'])->find($request->input('purchase_order_id'));
        // $type = Type::find($test->raw_material->type_id);
        // $store_stock = StoreStock::where('purchase_order_id',$request->input('purchase_order_id'))->sum('issued_quantity');
        // $store_material_stock = StoreStock::where('purchase_order_id',$request->input('purchase_order_id'))->sum('issued_material_quantity');
        // $available_quantity = ($purchase_order->po_quantity)-$store_stock;
        // $available_material = ($purchase_order->material_quantity)-$store_material_stock;
        // $unit_material_quantity = $purchase_order->unit_material_quantity;
        // return response(['test' => $test,'type' => $type,'supplier'=>$supplier,'available_quantity'=>$available_quantity,'available_material'=>$available_material,'unit_material_quantity'=>$unit_material_quantity]);
        // $html = view('store.supplier_details',compact('supplier'))->render();
        // return response(['html' => $html]);
    }

    public function getRawMaterials(Request $request)
    {
        if($request->type_id)
        {
            $raw_materials = RawMaterial::where('type_id',$request->type_id)->get();
            $html='<option value="">Select Material</option>';
            foreach($raw_materials as $raw_material)
            {
                $html.='<option value="'.$raw_material->id.'">'.$raw_material->name.'</option>';
            }

            return $html;
        }
    }
    public function getMaterialPurchaseOrder(Request $request)
    {
        if($request->raw_material_id)
        {
            $purchase_orders = PurchaseOrderItem::with('purchase_order','raw_material')->where('raw_material_id',$request->raw_material_id)->GroupBy('purchase_order_id')->get();
            //$purchase_order = PoMaster::with('raw_material')->where('raw_material_id',$request->raw_material_id)->get();
            $html = '<option value="">Select Purchase Order</option>';
            foreach($purchase_orders as $order)
            {
                $html.='<option value="'.$order->purchase_order_id.'">'.$order->purchase_order->purchase_order_number.'</option>';
            }
            $material = RawMaterial::find($request->raw_material_id);
            $uomlist = "<option value='".$material->uom_id."'>".$material->uom->name."</option>";
            return response(['orders'=>$html,'uom'=>$uomlist]);$html;
            //return json_encode($purchase_order);
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
    public function download($id)
    {   
        $store = StoreStock::find($id);
        return Response::download($store->inspection_report);
    }
}

