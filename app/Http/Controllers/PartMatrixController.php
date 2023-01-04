<?php

namespace App\Http\Controllers;

use App\Models\PartMatrix;
use App\Models\AssemblePartNumber;
use App\Models\ChildPartNumber;
use App\Models\Type;
use App\Models\Uom;
use App\Http\Requests\StorePartMatrixRequest;
use App\Http\Requests\UpdatePartMatrixRequest;
use DB;
class PartMatrixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assemble_part_numbers = AssemblePartNumber::get();
        $child_part_numbers = ChildPartNumber::get();
        $types = Type::get();
        $uoms = Uom::all();
        return view('part_matrix.create',compact('assemble_part_numbers','child_part_numbers','types','uoms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePartMatrixRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartMatrixRequest $request)
    {
        DB::beginTransaction();
        try {
            $child_part_numbers = $request->input('child_part_number_id');
            $assemble_part_number = $request->input('assemble_part_number_id');
            foreach ($child_part_numbers as $key => $child_part_number) {
                $part_matrix = new PartMatrix;
                $part_matrix->assemble_part_number_id = $assemble_part_number;
                $part_matrix->child_part_number_id = $child_part_number;
                $part_matrix->save();
                }
            DB::commit();
            return back()->withSuccess('Part Matix Created Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return back()->withError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PartMatrix  $partMatrix
     * @return \Illuminate\Http\Response
     */
    public function show(PartMatrix $partMatrix)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PartMatrix  $partMatrix
     * @return \Illuminate\Http\Response
     */
    public function edit(PartMatrix $partMatrix)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePartMatrixRequest  $request
     * @param  \App\Models\PartMatrix  $partMatrix
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartMatrixRequest $request, PartMatrix $partMatrix)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PartMatrix  $partMatrix
     * @return \Illuminate\Http\Response
     */
    public function destroy(PartMatrix $partMatrix)
    {
        //
    }
}
