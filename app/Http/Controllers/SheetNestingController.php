<?php

namespace App\Http\Controllers;

use App\Models\SheetNesting;
use App\Models\Category;
use App\Models\Type;
use App\Models\ChildPartNumber;
use App\Models\PartMaster;
use App\Models\RawMaterial;
use App\Http\Requests\StoreSheetNestingRequest;
use App\Http\Requests\UpdateSheetNestingRequest;
use Illuminate\Http\Request;
use DataTables;
use DB;

class SheetNestingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = SheetNesting::with(['raw_material','catgory','type','child_part_number'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){  
                    $btn='';     
                        $btn = '<a href="'.route('sheet_nesting.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editMaterialType">Edit</a>';
                        return $btn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
                }
        return view('sheet_nesting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status',1)->where('id',2)->get();
        $types = Type::where('category_id',2)->where('status',1)->get();
        $raw_materials = RawMaterial::where('type_id',1)->where('status',1)->get();
        $child_part_numbers = ChildPartNumber::where('status',1)->get();
        $next_nesting_number = Sheetnesting::getNextNestingNumber();
        return view('sheet_nesting.create',compact('categories','types','raw_materials','child_part_numbers','next_nesting_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSheetNestingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSheetNestingRequest $request)
    {
        //dd($request->all());
         DB::beginTransaction();
        try {
            $nesting_number = $request->input('nesting_number');
            $raw_material_id = $request->raw_material_id;
            $category_id = $request->category_id;
            $types_ids = $request->input('type_id');
            $child_part_numbers = $request->input('child_part_number_id');
            $quantities = $request->input('quantity');
            foreach ($types_ids as $key => $type_id) {
                $nesting = new SheetNesting;
                $nesting->nesting_number = $nesting_number;
                $nesting->raw_material_id = $raw_material_id;
                $nesting->category_id = $category_id;
                $nesting->type_id = $type_id;
                $nesting->child_part_number_id = $child_part_numbers[$key];
                $nesting->quantity = $quantities[$key];
                $nesting->unit_weight = 0;
                $nesting->total_weight = 0;
                $nesting->save();
            }
           DB::commit();
          return response()->json('Success', 200);
            //return back()->withSuccess('Nesting Created Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json($th->getMessage(),400);
            //return back()->withError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SheetNesting  $sheetNesting
     * @return \Illuminate\Http\Response
     */
    public function show(SheetNesting $sheetNesting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SheetNesting  $sheetNesting
     * @return \Illuminate\Http\Response
     */
    public function edit(SheetNesting $sheetNesting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSheetNestingRequest  $request
     * @param  \App\Models\SheetNesting  $sheetNesting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSheetNestingRequest $request, SheetNesting $sheetNesting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SheetNesting  $sheetNesting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SheetNesting $sheetNesting)
    {
        //
    }
    public function nesting_master()
    {
        $types = Type::where('category_id',2)->where('status',1)->get();
        $html = view('sheet_nesting.nesting_master',compact('types'))->render();
        return response(['html' => $html]);
    }
    public function get_child_parts(Request $request)
    {
        $type_id = $request->type_id;
        $child_part_numbers = PartMaster::with('child_part')->where('type_id',$type_id)->where('status',1)->get();
        $html = view('sheet_nesting.child_parts',compact('child_part_numbers'))->render();
        return response(['html' => $html]);
    }

}
