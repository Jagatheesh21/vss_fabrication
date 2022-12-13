<?php

namespace App\Http\Controllers;

use App\Models\ChildPartBom;
use App\Models\ChildPartNumber;
use App\Models\PartMaster;
use App\Models\Type;
use App\Models\RawMaterial;
use App\Models\Nesting;
use App\Models\NestingSequence;
use App\Http\Requests\StoreChildPartBomRequest;
use App\Http\Requests\UpdateChildPartBomRequest;
use DataTables;
use Illuminate\Http\Request;

class ChildPartBomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = ChildPartBom::with(['type','raw_material','nesting','nesting_type','child_part_number'])->latest()->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
       
                               $btn = '<a href="'.route('child_part_bom.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
               
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                    }
                    return view('child_part_bom.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $bom_number = ChildPartBom::getNextBomNumber();
        $child_part_numbers = ChildPartNumber::where('status',1)->get();
        $types = Type::where('status',1)->get();
        $raw_materials = RawMaterial::where('status',1)->get();
        $nestings = Nesting::where('status',1)->get();
        return view('child_part_bom.create',compact('child_part_numbers','types','raw_materials','nestings','bom_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChildPartBomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChildPartBomRequest $request)
    {
        
        $type_id = $request->input('type_id');
        $type = Type::find($type_id);
        $nesting_type_ids = $request->input('nesting_type_id');
        $child_part_number_ids = $request->input('child_part_number_id');
        $quantities = $request->input('quantity');
        // foreach($nesting_type_ids as $key=>$nesting_type_id)
        // {
        //     //echo $nesting_type_id;
        //     echo $quantities[$key];
        // }
        // exit;
        // if(!isset($quantities))
        // {
        //     return back()->withError('Quantity Value is Required..');
        // }else{
        //     foreach($quantities as $quantity)
        //     {
        //         if($quantity==null || $quantity==0){
        //             return back()->withError('Quantity Value is Required..');
        //         }
        //     }
        // }

        try {
            foreach($nesting_type_ids as $key=>$nesting_type_id){
                
                ChildPartBom::create([
                    'bom_id' => $request->bom_id, 
                    'category_id' => $type->category_id, 
                    'type_id' => $request->type_id, 
                    'raw_material_id' => $request->raw_material_id, 
                    'nesting_id' => $request->nesting_id, 
                    'nesting_type_id' => $nesting_type_ids[$key], 
                    'child_part_number_id' => $child_part_number_ids[$key], 
                    'quantity' => $quantities[$key], 
                ]);
                // $bom = new ChildPartBom;
                // $bom->bom_id = $request->bom_id;
                // $bom->category_id = $type->category_id;
                // $bom->type_id = $request->type_id;
                // $bom->raw_material_id = $request->raw_material_id;
                // $bom->nesting_id = $request->nesting_id;
                // $bom->nesting_type_id = $nesting_type_id;
                // $bom->child_part_number_id = $child_part_number_ids[$key];
                // $bom->quantity= $quantities[$key];
                // $bom->save();
            }
            return back()->withSuccess('BOM Created Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->withError($th->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChildPartBom  $childPartBom
     * @return \Illuminate\Http\Response
     */
    public function show(ChildPartBom $childPartBom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChildPartBom  $childPartBom
     * @return \Illuminate\Http\Response
     */
    public function edit(ChildPartBom $childPartBom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChildPartBomRequest  $request
     * @param  \App\Models\ChildPartBom  $childPartBom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChildPartBomRequest $request, ChildPartBom $childPartBom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChildPartBom  $childPartBom
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChildPartBom $childPartBom)
    {
        //
    }

    public function getNestingSequence(Request $request)
    {
        $nesting_id = $request->input('nesting_id');
        $types = Type::where('category_id',2)->where('status',1)->get();
        $nesting_types = NestingSequence::where('nesting_id',$nesting_id)->get();
        $child_part_numbers = ChildPartNumber::whereStatus(1)->get();
        $html = view('bom_master.nesting_types', compact('nesting_types','types','child_part_numbers'))->render();
        return response(['html' => $html]);
    }
    public function getChildPartnumber(Request $request)
    {
        $nesting_type_id = $request->input('nesting_type_id');
        $part_masters = PartMaster::where('type_id',$nesting_type_id)->where('status',1)->get();
        $html = view('bom_master.child_part_numbers', compact('part_masters'))->render();
        return response(['html' => $html]);
    }
    public function getRawMaterials(Request $request)
    {
        $type_id = $request->input('type_id');
        $raw_materials = RawMaterial::where('type_id',$type_id)->get();
        $nestings = Nesting::where('status',1)->get();
        $html = view('bom_master.raw_materials',compact('raw_materials','nestings'))->render();
        return response(['html' => $html]);
    }
}
