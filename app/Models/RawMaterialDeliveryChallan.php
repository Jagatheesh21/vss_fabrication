<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialDeliveryChallan extends Model
{
    use HasFactory;
    protected $fillable = ['dc_number','grn_id','sub_contractor_id','raw_material_id','uom_id','part_number_id','issued_quantity','closed_status','closed_date','created_by','created_ip'];
    public static function getNextDcNumber()
    {
        // Get the last created order
        $lastOrder = RawMaterialDeliveryChallan::orderBy('created_at','desc')->first();
    
        if ( ! $lastOrder )
        {
            // We get here if there is no order at all
            // If there is no number set it to 0, which will be 1 at the end.
            $number = 0;
            $po = 'DC-U2-'.date('y'). sprintf('%05d', intval($number) + 1);
        }
        else 
        {    
            $number = substr($lastOrder->grn_number,5);
            $po = 'DC-U2-'.date('y'). sprintf('%05d', intval($number) + 1);
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
}
