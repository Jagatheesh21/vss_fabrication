<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NestingSequence extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['nesting_id','type_id'];

    /**
     * Get the user that owns the NestingSequence
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nesting()
    {
        return $this->belongsTo(Nesting::class, 'nesting_id');
    }
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
