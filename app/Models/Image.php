<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Image extends Model
{
    use HasFactory;

    /**
     * return product has images
     * @return Product
     */
    public function images()
    {
        return $this->belongsTo(Product::class);
    }
}
