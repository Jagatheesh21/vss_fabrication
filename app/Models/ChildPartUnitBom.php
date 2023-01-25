<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildPartUnitBom extends Model
{
    use HasFactory;
    /**
     * Get the user that owns the ChildPartUnitBom
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function child_part_number()
    {
        return $this->belongsTo(ChildPartNumber::class, 'child_part_number_id');
    }
    public function uom()
    {
        return $this->belongsTo(Uom::class, 'uom_id');
    }
}
