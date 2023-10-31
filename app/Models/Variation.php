<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;

    protected $fillable = ["title","quantity","additional_price","product_id"];

    public function product(){
        $this->belongsTo(Product::class);
    }
}
