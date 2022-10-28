<?php

namespace App\Http\Controllers;

use App\Models\Nesting;
use App\Models\Type;
use App\Http\Requests\StoreNestingRequest;
use App\Http\Requests\UpdateNestingRequest;
use DataTables;
use Illuminate\Http\Request;

class NestingController extends Controller
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
            $data = Nesting::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '<a href="'.route('nesting.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPartMaster">Edit</a>';
                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('nesting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nesting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNestingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNestingRequest $request)
    {
        //dd($request->all());
        try {
           Nesting::create($request->validated());
            return redirect()->back()->withSuccess('Nesting Added Sucessfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->withError($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nesting  $nesting
     * @return \Illuminate\Http\Response
     */
    public function show(Nesting $nesting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nesting  $nesting
     * @return \Illuminate\Http\Response
     */
    public function edit(Nesting $nesting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNestingRequest  $request
     * @param  \App\Models\Nesting  $nesting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNestingRequest $request, Nesting $nesting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nesting  $nesting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nesting $nesting)
    {
        //
    }
}
