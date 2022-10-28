<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class StoreTransaction extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['route_card_type_id','route_card_number','category_id','type_id','raw_material_id','uom_id','nesting_id','child_part_number_id','quantity','created_by'];
    
    public static function getNextRouteCardNumber()
    {
        // Get the last created order
        $lastOrder = StoreTransaction::orderBy('created_at', 'desc')->first();
    
        if ( ! $lastOrder )
            // We get here if there is no order at all
            // If there is no number set it to 0, which will be 1 at the end.
    
            $number = 0;
        else 
            $number = substr($lastOrder->route_card_number, 3);
    
        // If we have A000001 in the database then we only want the number
        // So the substr returns this 000001
    
        // Add the string in front and higher up the number.
        // the %05d part makes sure that there are always 6 numbers in the string.
        // so it adds the missing zero's when needed.
     
        return 'A' .date('Y'). sprintf('%06d', intval($number) + 1);
    }
}
