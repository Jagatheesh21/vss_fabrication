<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Uom extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'uom';
    protected $fillable = ['name','display_name','status'];
}
