<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','reviewer_name', 'rating', 'comment'];

    function product(){
        return $this->belongsTo(Product::class);
    }
}
