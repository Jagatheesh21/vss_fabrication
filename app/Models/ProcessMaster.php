<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessMaster extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['child_part_number_id','operation_id','status'];

    /**
     * Get the user that owns the ProcessMaster
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function child_part_number()
    {
        return $this->belongsTo(ChildPartNumber::class, 'child_part_number_id');
    }
    public function operation()
    {
        return $this->belongsTo(Operation::class, 'operation_id');
    }

}
