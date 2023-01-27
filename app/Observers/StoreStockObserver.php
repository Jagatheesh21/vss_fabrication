<?php

namespace App\Observers;
use Illuminate\Http\Request;
use App\Models\StoreStock;
use App\Models\PurchaseOrder;
use App\Models\RouteCardTransaction;
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
        dd($storeStock);
    $total_inward_quantity = StoreStock::find($storeStock->id);
    $stock = StoreStock::find($storeStock->store_stock_id);
        $total_quantity = ($stock->checked_quantity)*($store->unit_material_quantity);
        $total_material_quantity = ($stock->checked_quantity);
        $available_quantity = $stock->available_material_quantity;
        $issued_qty = RouteCardTransaction::where('route_card_number',$storeStock->route_card_number)->sum('issued_raw_material_quantity');
        $balance_quantity = $available_quantity-$issued_qty;
        $store_stock = StoreStock::find($stock->id);
        $store_stock->available_quantity = $balance_quantity;
        $store_stock->update;
    //     $purchase =  PurchaseOrder::find($storeStock->purchase_order_id);
    //    if($purchase->useage_quantity==$total_inward_quantity)
    //    {
    //     $purchase->closed_date = now();
    //    }else{
    //     $purchase->useage_quantity = $purchase->useage_quantity+$storeStock->inward_quantity;
    //    }
    //    $purchase->update();
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
