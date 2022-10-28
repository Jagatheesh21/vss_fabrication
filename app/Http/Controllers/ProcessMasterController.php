<?php

namespace App\Http\Controllers;

use App\Models\ProcessMaster;
use App\Models\ChildPartNumber;
use App\Models\Operation;
use App\Http\Requests\StoreProcessMasterRequest;
use App\Http\Requests\UpdateProcessMasterRequest;
use Illuminate\Http\Request;
use Datatables;

class ProcessMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = ProcessMaster::with(['child_part_number','operation'])->latest()->get();
      
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
                    return view('process_master.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $operations = Operation::whereStatus(1)->get();
        $child_part_numbers = ChildPartNumber::whereStatus(1)->get();
        return view('process_master.create',compact('child_part_numbers','operations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProcessMasterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcessMasterRequest $request)
    {
        
        try {
            $operation_ids = $request->input('operation_id');
            $child_part_number_id = $request->input('child_part_number_id');
            foreach($operation_ids as $key=>$operation_id)
            {
                $process = new ProcessMaster;
                $process->child_part_number_id = $child_part_number_id;
                $process->operation_id = $key;
                $process->save();
            }
            return back()->withSuccess('Process Created Successfully!');
            
        } catch (\Throwable $th) {
            //throw $th;
            return back()->withError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcessMaster  $processMaster
     * @return \Illuminate\Http\Response
     */
    public function show(ProcessMaster $processMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProcessMaster  $processMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcessMaster $processMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcessMasterRequest  $request
     * @param  \App\Models\ProcessMaster  $processMaster
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcessMasterRequest $request, ProcessMaster $processMaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcessMaster  $processMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcessMaster $processMaster)
    {
        //
    }
}
