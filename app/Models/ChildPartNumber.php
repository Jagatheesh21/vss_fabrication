<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildPartNumber extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','status'];
    /**
     * Get the part_type that owns the ChildPartNumber
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function part_type()
    {
        return $this->belongsTo(PartType::class, 'part_type_id');
    }
    public function bom()
    {
        return $this->belongsTo(ChildPartUnitBom::class, 'id');
    }
}
