<?php

namespace App\Observers;

use App\Models\PoMaster;
use App\Models\StoreStock;
use App\Models\RawMaterial;

class PoMasterObserver
{
    /**
     * Handle the PoMaster "created" event.
     *
     * @param  \App\Models\PoMaster  $poMaster
     * @return void
     */
    public function created(PoMaster $poMaster)
    {
        $raw = RawMaterial::find($poMaster->raw_material_id);
        $grn_number = StoreStock::getNextGrnNumber();
        $stock = new StoreStock;
        $stock->grn_number = $grn_number;
        $stock->purchase_order_id = $poMaster->id;
        $stock->supplier_id = $poMaster->supplier_id;
        $stock->invoice_number = $poMaster->invoice_number;
        $stock->category_id = 1;
        $stock->type_id = $raw->type_id;
        $stock->raw_material_id = $poMaster->raw_material_id;
        $stock->material_type_id =1;
        $stock->material_uom_id = $poMaster->material_uom_id;
        $stock->uom_id = $poMaster->uom_id;
        $stock->inward_quantity = $poMaster->po_quantity;
        $stock->inward_material_quantity = $poMaster->material_quantity;
        $stock->unit_material_quantity = $poMaster->unit_material_quantity;
        $stock->confirm = 1;
        $stock->checked_quantity = 0;
        $stock->available_quantity = 0;
        $stock->created_by = auth()->user()->id;            
        $stock->updated_by = auth()->user()->id;
        $stock->save();
    }

    /**
     * Handle the PoMaster "updated" event.
     *
     * @param  \App\Models\PoMaster  $poMaster
     * @return void
     */
    public function updated(PoMaster $poMaster)
    {
        //
    }

    /**
     * Handle the PoMaster "deleted" event.
     *
     * @param  \App\Models\PoMaster  $poMaster
     * @return void
     */
    public function deleted(PoMaster $poMaster)
    {
        //
    }

    /**
     * Handle the PoMaster "restored" event.
     *
     * @param  \App\Models\PoMaster  $poMaster
     * @return void
     */
    public function restored(PoMaster $poMaster)
    {
        //
    }

    /**
     * Handle the PoMaster "force deleted" event.
     *
     * @param  \App\Models\PoMaster  $poMaster
     * @return void
     */
    public function forceDeleted(PoMaster $poMaster)
    {
        //
    }
}
