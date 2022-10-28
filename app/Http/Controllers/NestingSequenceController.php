<?php

namespace App\Http\Controllers;

use App\Models\NestingSequence;
use App\Models\Nesting;
use App\Models\Type;

use App\Http\Requests\StoreNestingSequenceRequest;
use App\Http\Requests\UpdateNestingSequenceRequest;
use DataTables;
use Illuminate\Http\Request;

class NestingSequenceController extends Controller
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
            $data = NestingSequence::with(['type','nesting'])->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '<a href="'.route('nesting_sequence.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPartMaster">Edit</a>';
                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('nesting_sequence.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nestings = Nesting::where('status',1)->get();
        $types = Type::where('category_id',2)->where('status',1)->get();
        return view('nesting_sequence.create',compact('nestings','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNestingSequenceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNestingSequenceRequest $request)
    {
        try {
            $nesting_id = $request->nesting_id;
            $types = $request->type_id;
            foreach($types as $type)
            {
                NestingSequence::create([
                    'nesting_id' => $nesting_id,
                    'type_id' => $type
                ]);
            }
            return back()->withSuccess('Nesting Sequence Added Successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->withError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NestingSequence  $nestingSequence
     * @return \Illuminate\Http\Response
     */
    public function show(NestingSequence $nestingSequence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NestingSequence  $nestingSequence
     * @return \Illuminate\Http\Response
     */
    public function edit(NestingSequence $nestingSequence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNestingSequenceRequest  $request
     * @param  \App\Models\NestingSequence  $nestingSequence
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNestingSequenceRequest $request, NestingSequence $nestingSequence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NestingSequence  $nestingSequence
     * @return \Illuminate\Http\Response
     */
    public function destroy(NestingSequence $nestingSequence)
    {
        //
    }
}
