<?php

namespace App\Http\Controllers;

use App\Models\ChildPartUnitBom;
use App\Http\Requests\StoreChildPartUnitBomRequest;
use App\Http\Requests\UpdateChildPartUnitBomRequest;
use Illuminate\Http\Request;
use DataTables;
use App\Exports\ChildPartUnitBomExport;
use Maatwebsite\Excel\Facades\Excel;
class ChildPartUnitBomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = ChildPartUnitBom::with('child_part_number','uom')->latest()->get();
      
                return Datatables::of($data)
                        ->addIndexColumn()
                        // ->addColumn('action', function($row){
       
                        //        $btn = '<a href="'.route('child_part_unit_bom.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
               
                        //         return $btn;
                        // })
                        // ->rawColumns(['action'])
                        ->make(true);
                    }
                    return view('child_part_unit_bom.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChildPartUnitBomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChildPartUnitBomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChildPartUnitBom  $childPartUnitBom
     * @return \Illuminate\Http\Response
     */
    public function show(ChildPartUnitBom $childPartUnitBom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChildPartUnitBom  $childPartUnitBom
     * @return \Illuminate\Http\Response
     */
    public function edit(ChildPartUnitBom $childPartUnitBom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChildPartUnitBomRequest  $request
     * @param  \App\Models\ChildPartUnitBom  $childPartUnitBom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChildPartUnitBomRequest $request, ChildPartUnitBom $childPartUnitBom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChildPartUnitBom  $childPartUnitBom
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChildPartUnitBom $childPartUnitBom)
    {
        //
    }
    public function export()
    {
        return Excel::download(new ChildPartUnitBomExport, 'bom.xlsx');
    }
}
