<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    /**
     * get products  images
     * @return BelongsTo
     */
    public function images(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
