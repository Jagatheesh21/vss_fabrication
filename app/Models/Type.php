<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Type extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','name','status'];
    
        
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function child_part_numbers()
    {
        return $this->belongsToMany(ChildPartBom::class);
    }

}
