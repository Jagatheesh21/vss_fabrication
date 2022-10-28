<?php

namespace App\Http\Controllers;

use App\Models\RawMaterial;
use App\Models\Category;
use App\Models\Type;
use App\Http\Requests\StoreRawMaterialRequest;
use App\Http\Requests\UpdateRawMaterialRequest;
use DataTables;
use Illuminate\Http\Request;


class RawMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = RawMaterial::with(['category','type'])->latest()->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){       
                               $btn = '<a href="'.route('raw_material.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editMaterialType">Edit</a>';        
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                    }
                    return view('raw_material.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::where('category_id',1)->where('status',1)->get();
        return view('raw_material.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRawMaterialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRawMaterialRequest $request)
    {
        try {
            RawMaterial::create($request->validated());
            return redirect()->back()->withSuccess('Raw Material Added Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withError($th->getmessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RawMaterial  $rawMaterial
     * @return \Illuminate\Http\Response
     */
    public function show(RawMaterial $rawMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RawMaterial  $rawMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(RawMaterial $rawMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRawMaterialRequest  $request
     * @param  \App\Models\RawMaterial  $rawMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRawMaterialRequest $request, RawMaterial $rawMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RawMaterial  $rawMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawMaterial $rawMaterial)
    {
        //
    }
}
