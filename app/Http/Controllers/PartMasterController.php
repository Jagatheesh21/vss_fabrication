<?php

namespace App\Http\Controllers;

use App\Models\PartMaster;
use App\Models\Category;
use App\Models\Type;
use App\Models\ChildPartNumber;
use App\Models\Uom;
use App\Http\Requests\StorePartMasterRequest;
use App\Http\Requests\UpdatePartMasterRequest;
use DataTables;
use Illuminate\Http\Request;

class PartMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax())
        {
            $data = PartMaster::with(['category','type','child_part','uom'])->latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '<a href="'.route('part_master.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPartMaster">Edit</a>';
                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('part_master.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $types = Type::where('category_id',2)->get();
        $child_parts = ChildPartNumber::all();
        $uoms = Uom::all();
        return view('part_master.create',compact('categories','child_parts','types','uoms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePartMasterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartMasterRequest $request)
    {
        try {
            PartMaster::Create($request->validated());
            return back()->withSuccess('Part Master created Succesffully!');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->withError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PartMaster  $partMaster
     * @return \Illuminate\Http\Response
     */
    public function show(PartMaster $partMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PartMaster  $partMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(PartMaster $partMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePartMasterRequest  $request
     * @param  \App\Models\PartMaster  $partMaster
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartMasterRequest $request, PartMaster $partMaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PartMaster  $partMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(PartMaster $partMaster)
    {
        //
    }
}
