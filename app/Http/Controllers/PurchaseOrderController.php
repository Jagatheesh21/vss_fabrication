<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\RawMaterial;
use App\Models\Supplier;
use App\Http\Requests\StorePurchaseOrderRequest;
use App\Http\Requests\UpdatePurchaseOrderRequest;
use Illuminate\Http\Request;
use Datatables;
use PDF;
class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if($request->ajax()){
            $data = PurchaseOrder::with(['purchase_order_items','supplier'])->latest()->get();
      
                return Datatables::of($data)
                        ->addIndexColumn()
                        
                        ->addColumn('action', function($row){
       
                            $btn = '<a href="'.route('purchase_order.show',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">View</a>';        
                            $btn = '<a href="'.route('purchase_order.print',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Download</a>';        
                            return $btn;
                        })

                        ->rawColumns(['action'])
                        ->make(true);
                    }
                    return view('purchase_order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $po_number = PurchaseOrder::getNextPurchaseOrderNumber();
        $raw_materials = RawMaterial::whereStatus(1)->get();
        $suppliers = Supplier::whereStatus(1)->get();
        return view('purchase_order.purchase_order',compact('po_number','raw_materials','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchaseOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseOrderRequest $request)
    {
       //dd($request->all());
       
        try {
            $raw_materials = $request->input('raw_material_id');
            $quantities = $request->input('quantity');
            $prices = $request->input('price');
            $total_prices = $request->input('total');
            // Purchase Order
            $order = new PurchaseOrder;
            $order->purchase_order_number = $request->purchase_order_number;
            $order->supplier_id = $request->supplier_id;
            $order->cgst = $request->cgst;
            $order->sgst = $request->sgst;
            $order->igst = $request->igst;
            $order->tax = $request->tax;
            $order->tax_price = $request->tax_amount;
            $order->total_price = $request->total_amount;
            $order->sub_total = $request->sub_total;
            $order->purchase_order_date = $request->purchase_order_date;
            $order->reference_number = $request->reference_number;
            $order->invoice_number = $request->reference_number;
            $order->gst_number = $request->gst_number;
            $order->state = $request->state;
            $order->state_code = $request->state_code;
            $order->address = $request->address;
            $order->delivery_terms = $request->delivery_terms;
            $order->mode_of_dispatch = $request->mode_of_dispatch;
            $order->payment_terms = $request->payment_terms;
            $order->status = 1;
            $order->useage_quantity = 0;
            $order->save();
            // Purchase Order items
            foreach($raw_materials as $key=>$raw_material)
            {
                $item = new PurchaseOrderItem;
                $item->purchase_order_id = $order->id;
                $item->purchase_type_id = 1;
                $item->purchase_item_id = $raw_material;
                $item->raw_material_id = $raw_material;
                $item->uom_id = $raw_material;
                $item->quantity = $quantities[$key];
                $item->unit_price = $prices[$key];
                $item->total_price = $total_prices[$key];
                $item->save();
            }
           return response()->json(['success' => true,'message' =>'Purchase Order Created Successfully!'], 200);
            // return response()->json([
            //     "message" => "Success"
            // ]);
           //return redirect()->back()->withSuccess('Purchase Order Created Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
           //return response()->json(['error' => true,'message'=> $th->getMessage()], 200);
            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseOrderRequest  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseOrderRequest $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }
    public function print($id)
    {
        
        if($id)
        {
            $purchase_order = PurchaseOrder::with('purchase_order_items')->find($id);
            return $view = view('purchase_order.print',compact('purchase_order'))->render();
            // $view = view('purchase_order.print',compact('purchase_order'))->render();
            // $pdf = PDF::loadView($view);
            // return $pdf->download($view);
        }
    }
    public function get_supplier_details(Request $request)
    {
        $id = $request->supplier_id;
        return $supplier = Supplier::find($id);
    }
    public function getPurchaseItems(Request $request){
        $count = $request->count;
        $count = $count+1;
        $previous = $request->prev;
        $raw_materials = RawMaterial::with('type')->whereStatus(1)->get();
        $html = view('purchase_order.purchase_items',compact('raw_materials','count','previous'))->render();
        return response(['html'=>$html]);
    }
}
