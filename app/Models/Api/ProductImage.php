<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'images',
        'product_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
      }
}
