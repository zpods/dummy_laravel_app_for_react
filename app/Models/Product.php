<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Product extends Model
{
    use HasFactory;


    /**
     * return images belonging to particular product
     * @return Collection of Image
     */
    public function images(){
        return $this->hasMany(Image::class);
    }

}


