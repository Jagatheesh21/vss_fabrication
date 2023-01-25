<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SheetNesting extends Model
{
    use HasFactory;
    protected $fillable = ['nesting_number','raw_material_id','category_id','type_id','quantity','child_part_number_id','unit_weight','total_weight'];
    public static function getNextNestingNumber()
    {
        $lastOrder = SheetNesting::select('nesting_number')->orderBy('created_at', 'desc')->first();
        if ( ! $lastOrder )
            $number = 0;
        else 
            $number = substr($lastOrder->nesting_number, 3);
        return 'NES' . sprintf('%05d', intval($number) + 1);
    }
    /**
     * Get the user that owns the SheetNesting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
    public function child_part_number()
    {
        return $this->belongsTo(ChildPartNumber::class, 'child_part_number_id');
    }

}
