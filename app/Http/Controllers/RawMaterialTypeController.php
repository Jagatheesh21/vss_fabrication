<?php

namespace App\Http\Controllers;

use App\Models\RawMaterialType;
use App\Http\Requests\StoreRawMaterialTypeRequest;
use App\Http\Requests\UpdateRawMaterialTypeRequest;
use DataTables;
use Illuminate\Http\Request;


class RawMaterialTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = RawMaterialType::latest()->get();
      
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
       
                               $btn = '<a href="'.route('raw_material_type.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editMaterialType">Edit</a>';        
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                    }
                    return view('raw_material_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('raw_material_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRawMaterialTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRawMaterialTypeRequest $request)
    {
        try {
            RawMaterialType::create($request->validated());
            return redirect()->back()->withSuccess('Material Type Added Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withError($th->getmessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RawMaterialType  $rawMaterialType
     * @return \Illuminate\Http\Response
     */
    public function show(RawMaterialType $rawMaterialType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RawMaterialType  $rawMaterialType
     * @return \Illuminate\Http\Response
     */
    public function edit(RawMaterialType $rawMaterialType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRawMaterialTypeRequest  $request
     * @param  \App\Models\RawMaterialType  $rawMaterialType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRawMaterialTypeRequest $request, RawMaterialType $rawMaterialType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RawMaterialType  $rawMaterialType
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawMaterialType $rawMaterialType)
    {
        //
    }
}
