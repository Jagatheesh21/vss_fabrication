<?php

namespace App\Http\Controllers;

use App\Models\StoreTransaction;
use App\Http\Requests\StoreStoreTransactionRequest;
use App\Http\Requests\UpdateStoreTransactionRequest;

class StoreTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreStoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreTransaction  $storeTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(StoreTransaction $storeTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoreTransaction  $storeTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreTransaction $storeTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreTransactionRequest  $request
     * @param  \App\Models\StoreTransaction  $storeTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreTransactionRequest $request, StoreTransaction $storeTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreTransaction  $storeTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreTransaction $storeTransaction)
    {
        //
    }
}
