<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Operation extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['operation_type_id','name','description','status'];
/**
 * Get the user that owns the Operation
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function operation_type()
{
    return $this->belongsTo(OperationType::class, 'operation_type_id');
}
}
