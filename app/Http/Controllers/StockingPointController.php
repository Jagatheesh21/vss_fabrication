<?php

namespace App\Http\Controllers;

use App\Models\StockingPoint;
use App\Http\Requests\StoreStockingPointRequest;
use App\Http\Requests\UpdateStockingPointRequest;
use DataTables;
use Illuminate\Http\Request;

class StockingPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
  
            $data = StockingPoint::latest()->get();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="'.route('stocking_points.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                           //$btn = $btn.' <a href="'.route('operation.destroy',$row->id).'"  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('stocking_points.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stocking_points.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStockingPointRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStockingPointRequest $request)
    {
         try{
            StockingPoint::create($request->validated());
            return back()->with('success','Stocking Point Created Successfully!');
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return back()->with('error',$e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockingPoint  $stocking_point
     * @return \Illuminate\Http\Response
     */
    public function show(StockingPoint $stocking_point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockingPoint  $operation
     * @return \Illuminate\Http\Response
     */
    public function edit(StockingPoint $stocking_point)
    {

        return view('stocking_points.edit',compact('stocking_point'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOperationRequest  $request
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStockingPointRequest $request, StockingPoint $stocking_point)
    {
        
        try {
            $stocking_point->update($request->validated());
            return redirect()->back()->withSuccess('Stocking Point updated Successfully!!');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockingPoint $stocking_point)
    {
        try {
            $stocking_point->delete();
        return back()->withSuccess('message','Stocking Point Deleted Successfully!');
        } catch (\Throwable $th) {
            return back()->withError('message','Something Went Wrong.Please Try Again.');
        }
        
    }
}
