<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Nesting extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name'];

    /**
     * Get the user that owns the Nesting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

}
