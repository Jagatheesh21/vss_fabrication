<?php

namespace App\Observers;

use App\Models\StoreStock;
use App\Models\PurchaseOrder;

class StoreStockObserver
{
    /**
     * Handle the StoreStock "created" event.
     *
     * @param  \App\Models\StoreStock  $storeStock
     * @return void
     */
    public function created(StoreStock $storeStock)
    {
       $purchase =  PurchaseOrder::find($request->purchase_order_id);
       
       $purchase->available_quantity = $purchase->available_quantity+$storeStock->inward_quantity;


    }

    /**
     * Handle the StoreStock "updated" event.
     *
     * @param  \App\Models\StoreStock  $storeStock
     * @return void
     */
    public function updated(StoreStock $storeStock)
    {
        //
    }

    /**
     * Handle the StoreStock "deleted" event.
     *
     * @param  \App\Models\StoreStock  $storeStock
     * @return void
     */
    public function deleted(StoreStock $storeStock)
    {
        //
    }

    /**
     * Handle the StoreStock "restored" event.
     *
     * @param  \App\Models\StoreStock  $storeStock
     * @return void
     */
    public function restored(StoreStock $storeStock)
    {
        //
    }

    /**
     * Handle the StoreStock "force deleted" event.
     *
     * @param  \App\Models\StoreStock  $storeStock
     * @return void
     */
    public function forceDeleted(StoreStock $storeStock)
    {
        //
    }
}
