<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ["title","quantity","description", "base_price"];
    public function variations(){
        return $this->hasMany(Variation::class);
    }
}
