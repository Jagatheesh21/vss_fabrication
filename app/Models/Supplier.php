<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ['name','company_name','gst_number','address','mobile_number','contact_number','vendor_code','contact_person','hsn_code','status'];
}
