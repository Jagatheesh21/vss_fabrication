<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PartMaster extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','type_id','child_part_id','uom_id','description','status'];

    public function category()
    {
    return $this->belongsTo(Category::class,'category_id');
    }
    public function type()
    {
        return $this->belongsTo(Type::class,'type_id');
    }
    public function child_part()
    {
        return $this->belongsTo(ChildPartNumber::class,'child_part_id');
    }
    public function uom()
    {
        return $this->belongsTo(Uom::class,'uom_id');
    }
    
}
