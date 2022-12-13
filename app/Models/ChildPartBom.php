<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChildPartBom extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['bom_id','category_id','type_id','raw_material_id','nesting_id','nesting_type_id','child_part_number_id','quantity'];

    public static function getNextBomNumber()
{
    // Get the last created order
    $lastOrder = ChildPartBom::orderBy('created_at', 'desc')->first();

    if ( ! $lastOrder )
        // We get here if there is no order at all
        // If there is no number set it to 0, which will be 1 at the end.

        $number = 0;
    else 
        $number = substr($lastOrder->bom_id, 3);

    // If we have ORD000001 in the database then we only want the number
    // So the substr returns this 000001

    // Add the string in front and higher up the number.
    // the %05d part makes sure that there are always 6 numbers in the string.
    // so it adds the missing zero's when needed.
 
    return 'BOM' . sprintf('%06d', intval($number) + 1);
}
/**
 * Get the user that owns the ChildPartBom
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function category()
{
    return $this->belongsTo(Categoty::class, 'category_id');
}
public function type()
{
    return $this->belongsTo(Type::class, 'type_id');
}
public function nesting()
{
    return $this->belongsTo(Nesting::class, 'nesting_id');
}
public function nesting_type()
{
    return $this->belongsTo(Type::class, 'nesting_type_id');
}
public function raw_material()
{
    return $this->belongsTo(RawMaterial::class, 'raw_material_id');
}
public function child_part_number()
{
    return $this->belongsTo(ChildPartNumber::class, 'child_part_number_id');
}
}
