<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoMaster extends Model
{
    use HasFactory;
    protected $fillable = ['rm_po_number','po_date','supplier_id','raw_material_id','invoice_number','uom_id','po_quantity','material_quantity','material_uom_id','unit_material_quantity','remarks'];
    
    public static function getNextPurchaseOrderNumber()
    {
        $lastOrder = PoMaster::orderBy('created_at','desc')->first();
    
        if ( ! $lastOrder )
        {
            $number = 0;
            $po = 'PO'.date('y'). sprintf('%05d', intval($number) + 1);
        }
        else 
        {    
            $number = substr($lastOrder->rm_po_number,4);
            $po = 'PO'.date('y'). sprintf('%05d', intval($number) + 1);
        }
    }
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    /**
     * Get the raw_material that owns the PoMaster
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function raw_material()
    {
        return $this->belongsTo(RawMaterial::class, 'raw_material_id');
    }
    /**
     * Get the uom that owns the PoMaster
     *
     * @return \Illuminate\DatabaUomloquent\Relations\BelongsTo
     */
    public function uom()
    {
        return $this->belongsTo(Uom::class, 'uom_id');
    }
    public function material_uom()
    {
        return $this->belongsTo(Uom::class, 'material_uom_id');
    }

}
