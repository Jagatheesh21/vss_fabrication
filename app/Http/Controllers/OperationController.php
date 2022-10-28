<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Http\Requests\StoreOperationRequest;
use App\Http\Requests\UpdateOperationRequest;
use DataTables;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
  
            $data = Operation::with('operation_type')->latest()->get();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="'.route('operation.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                           //$btn = $btn.' <a href="'.route('operation.destroy',$row->id).'"  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('operations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOperationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOperationRequest $request)
    {
        //dd($request->all());
         try{
            Operation::create($request->validated());
            return redirect()->back()->withSuccess('Operation Created Successfully!');
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function show(Operation $operation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function edit(Operation $operation)
    {

        return view('operations.edit',compact('operation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOperationRequest  $request
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOperationRequest $request, Operation $operation)
    {
        
        try {
            $operation->update($request->validated());
            return redirect(route('operation.index'))->withSuccess('Operation updated Successfully!!');
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
    public function destroy(Operation $operation)
    {
        try {
            $operation->delete();
        return back()->withSuccess('message','Operation Deleted Successfully!');
        } catch (\Throwable $th) {
            return back()->withError('message','Something Went Wrong.Please Try Again.');
        }
        
    }
}
