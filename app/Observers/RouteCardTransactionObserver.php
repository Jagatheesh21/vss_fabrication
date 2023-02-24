<?php

namespace App\Observers;

use App\Models\RouteCardTransaction;
use App\Models\StoreStock;
use App\Models\SheetNesting;
class RouteCardTransactionObserver
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function created(RouteCardTransaction $routeCardTransaction) 
    {
        $stock = StoreStock::find($routeCardTransaction->store_stock_id);
        $total_quantity = ($stock->checked_quantity)*($stock->unit_material_quantity);
        $total_material_quantity = ($stock->checked_quantity);
        $available_quantity = $stock->available_material_quantity;
        $issued_qty = RouteCardTransaction::where('route_card_number',$routeCardTransaction->route_card_number)->sum('issued_raw_material_quantity');
        $balance_quantity = $available_quantity-$issued_qty;
        $store_stock = StoreStock::find($routeCardTransaction->store_stock_id);
        $store_stock->available_quantity = $balance_quantity;
        $store_stock->update;

    }

    /**
     * Handle the RouteCardTransaction "updated" event.
     *
     * @param  \App\Models\RouteCardTransaction  $routeCardTransaction
     * @return void
     */
    public function updated(RouteCardTransaction $routeCardTransaction)
    {
        //
    }

    /**
     * Handle the RouteCardTransaction "deleted" event.
     *
     * @param  \App\Models\RouteCardTransaction  $routeCardTransaction
     * @return void
     */
    public function deleted(RouteCardTransaction $routeCardTransaction)
    {
        //
    }

    /**
     * Handle the RouteCardTransaction "restored" event.
     *
     * @param  \App\Models\RouteCardTransaction  $routeCardTransaction
     * @return void
     */
    public function restored(RouteCardTransaction $routeCardTransaction)
    {
        //
    }

    /**
     * Handle the RouteCardTransaction "force deleted" event.
     *
     * @param  \App\Models\RouteCardTransaction  $routeCardTransaction
     * @return void
     */
    public function forceDeleted(RouteCardTransaction $routeCardTransaction)
    {
        //
    }
}
