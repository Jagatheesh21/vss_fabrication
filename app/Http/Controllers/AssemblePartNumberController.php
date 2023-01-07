<?php

namespace App\Http\Controllers;

use App\Models\AssemblePartNumber;
use App\Http\Requests\StoreAssemblePartNumberRequest;
use App\Http\Requests\UpdateAssemblePartNumberRequest;

class AssemblePartNumberController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAssemblePartNumberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssemblePartNumberRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssemblePartNumber  $assemblePartNumber
     * @return \Illuminate\Http\Response
     */
    public function show(AssemblePartNumber $assemblePartNumber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssemblePartNumber  $assemblePartNumber
     * @return \Illuminate\Http\Response
     */
    public function edit(AssemblePartNumber $assemblePartNumber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssemblePartNumberRequest  $request
     * @param  \App\Models\AssemblePartNumber  $assemblePartNumber
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssemblePartNumberRequest $request, AssemblePartNumber $assemblePartNumber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssemblePartNumber  $assemblePartNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssemblePartNumber $assemblePartNumber)
    {
        //
    }
}
