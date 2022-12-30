<?php

namespace App\Observers;
use Illuminate\Http\Request;
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
        $total_inward_quantity = StoreStock::where('purchase_order_id',$storeStock->purchase_order_id)->sum('inward_quantity');
        $purchase =  PurchaseOrder::find($storeStock->purchase_order_id);
       if($purchase->useage_quantity==$total_inward_quantity)
       {
        $purchase->closed_date = now();
       }else{
        $purchase->useage_quantity = $purchase->useage_quantity+$storeStock->inward_quantity;
       }
       $purchase->update();
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
