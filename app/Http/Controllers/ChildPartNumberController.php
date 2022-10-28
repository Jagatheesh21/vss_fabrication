<?php

namespace App\Http\Controllers;

use App\Models\ChildPartNumber;
use App\Http\Requests\StoreChildPartNumberRequest;
use App\Http\Requests\UpdateChildPartNumberRequest;
use DataTables;
use Illuminate\Http\Request;
class ChildPartNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = ChildPartNumber::latest()->get();
      
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
       
                               $btn = '<a href="'.route('child_part_number.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
       
                               //$btn = $btn.' <a href="'.route('operation.destroy',$row->id).'"  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
        
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                    }
                    return view('child_part_number.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('child_part_number.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChildPartNumberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChildPartNumberRequest $request)
    {
        try {
            ChildPartNumber::create($request->validated());
            return back()->withSuccess('Child Part Number Created Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->withError($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChildPartNumber  $childPartNumber
     * @return \Illuminate\Http\Response
     */
    public function show(ChildPartNumber $childPartNumber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChildPartNumber  $childPartNumber
     * @return \Illuminate\Http\Response
     */
    public function edit(ChildPartNumber $childPartNumber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChildPartNumberRequest  $request
     * @param  \App\Models\ChildPartNumber  $childPartNumber
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChildPartNumberRequest $request, ChildPartNumber $childPartNumber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChildPartNumber  $childPartNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChildPartNumber $childPartNumber)
    {
        //
    }
}
