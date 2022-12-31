<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['purchase_order_number','raw_material_id','supplier_id','unit_quantity','total_quantity','purchase_order_date','uom_id','invoice_number','quantity','purchase_status'];
    public static function getNextPurchaseOrderNumber()
{
    // Get the last created order
    $lastOrder = PurchaseOrder::orderBy('created_at','desc')->first();

    if ( ! $lastOrder )
    {
        // We get here if there is no order at all
        // If there is no number set it to 0, which will be 1 at the end.
        $number = 0;
        $po = 'PO'.date('y'). sprintf('%04d', intval($number) + 1);
    }
    else 
    {    
        $number = substr($lastOrder->purchase_order_number,4);
        $po = 'PO'.date('y'). sprintf('%05d', intval($number) + 1);
        //$number = $last
    // If we have PO000001 in the database then we only want the number
    // So the substr returns this 000001

    // Add the string in front and higher up the number.
    // the %06d part makes sure that there are always 6 numbers in the string.
    // so it adds the missing zero's when needed.
    //return $number;
    }
    
    return $po;
}
/**
 * Get the user that owns the PurchaseOrder
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function supplier()
{
    return $this->belongsTo(Supplier::class, 'supplier_id');
}
public function raw_material()
{
    return $this->belongsTo(RawMaterial::class, 'raw_material_id');
}
public function uom()
{
    return $this->belongsTo(Uom::class, 'uom_id');
}
}
