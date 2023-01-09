<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreStock extends Model
{
    use HasFactory;

    public function purchase_order()
{
    return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id');
}
public static function getNextGrnNumber()
{
    // Get the last created order
    $lastOrder = StoreStock::orderBy('created_at','desc')->first();

    if ( ! $lastOrder )
    {
        // We get here if there is no order at all
        // If there is no number set it to 0, which will be 1 at the end.
        $number = 0;
        $po = 'GRN'.date('y'). sprintf('%05d', intval($number) + 1);
    }
    else 
    {    
        $number = substr($lastOrder->grn_number,4);
        $po = 'GRN'.date('y'). sprintf('%05d', intval($number) + 1);
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
 * Get the user that owns the StoreStock
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function raw_material()
{
    return $this->belongsTo(RawMaterial::class, 'raw_material_id');
}
public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}
public function type()
{
    return $this->belongsTo(Type::class, 'type_id');
}
public function uom()
{
    return $this->belongsTo(Uom::class, 'uom_id');
}
public function material_uom()
{
    return $this->belongsTo(Uom::class, 'material_uom_id');
}

}
