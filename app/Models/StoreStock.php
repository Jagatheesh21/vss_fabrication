<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreStock extends Model
{
    use HasFactory;

    public function purchase_order()
{
    return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id');
}
}
