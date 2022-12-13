<?php

namespace App\Http\Controllers;

use App\Models\GoodReceivedNote;
use App\Models\PurchaseOrder;
use App\Models\StoreStock;
use App\Http\Requests\StoreGoodReceivedNoteRequest;
use App\Http\Requests\UpdateGoodReceivedNoteRequest;
use Auth;
use Illuminate\Http\Request;
use Datatables;

class GoodReceivedNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = GoodReceivedNote::with(['purchase_order','uom','user'])->latest()->get();
      
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
       
                               $btn = '<a href="'.route('good_received_note.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
       
                               //$btn = $btn.' <a href="'.route('operation.destroy',$row->id).'"  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
        
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                    }
                    return view('good_received_note.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // $purchase_orders = PurchaseOrder::where('status',1)->where('checked_quantity',0)->get();
       $grn_number = GoodReceivedNote::getNextGrnNumber(); 
       $purchase_orders = PurchaseOrder::where('status',1)->get();
    //    $store_stocks = StoreStock::whereHas('purchase_order', function($q)
    //     {
    //         $q->where('status',1);
        
    //     })->get();
        
        return view('good_received_note.create',compact('grn_number','purchase_orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGoodReceivedNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoodReceivedNoteRequest $request)
    {
    try {
        //GoodReceivedNote::create($request->validated());
        $grn = new GoodReceivedNote;
        $grn->grn_number = $request->input('grn_number');
        $grn->purchase_order_id = $request->input('purchase_order_id');
        $grn->raw_material_id = $request->input('raw_material_id');
        $grn->uom_id = $request->input('uom_id');
        $grn->checked_quantity = $request->input('checked_quantity');
        $grn->checked_date = $request->input('checked_date');
        $grn->checked_by = auth()->user()->id;
        $grn->save();
        return back()->withSuccess('GRN Generated Successfully!');
        
    } catch (\Throwable $th) {
        //throw $th;
        return back()->withError($th->getMessage());
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GoodReceivedNote  $goodReceivedNote
     * @return \Illuminate\Http\Response
     */
    public function show(GoodReceivedNote $goodReceivedNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GoodReceivedNote  $goodReceivedNote
     * @return \Illuminate\Http\Response
     */
    public function edit(GoodReceivedNote $goodReceivedNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGoodReceivedNoteRequest  $request
     * @param  \App\Models\GoodReceivedNote  $goodReceivedNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGoodReceivedNoteRequest $request, GoodReceivedNote $goodReceivedNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GoodReceivedNote  $goodReceivedNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoodReceivedNote $goodReceivedNote)
    {
        //
    }
}
