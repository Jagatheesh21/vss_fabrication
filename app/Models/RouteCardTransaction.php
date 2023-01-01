<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteCardTransaction extends Model
{
    use HasFactory;
    public static function getNextRouteCardNumber($type)
    {
        // Get the last created order

        $lastOrder = RouteCardTransaction::where('route_card_type_id',$type)->orderBy('created_at', 'desc')->first();
    
        if ( ! $lastOrder )
            // We get here if there is no order at all
            // If there is no number set it to 0, which will be 1 at the end.
    
            $number = 0;
        else 
            $number = substr($lastOrder->route_card_number, 5);
    
        // If we have A000001 in the database then we only want the number
        // So the substr returns this 000001
    
        // Add the string in front and higher up the number.
        // the %05d part makes sure that there are always 6 numbers in the string.
        // so it adds the missing zero's when needed.
     
        return 'A' .date('Y'). sprintf('%06d', intval($number) + 1);
    }
}
