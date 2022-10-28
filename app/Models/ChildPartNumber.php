<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildPartNumber extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','status'];
}
