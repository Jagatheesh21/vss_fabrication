<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartMatrix extends Model
{
    use HasFactory;
    protected $fillable = ['assemble_part_number_id','child_part_number_id'];
}
