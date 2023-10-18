<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function light_requirement()
    {
        return $this->hasMany(LightRequirement::class);
    }

    public function product_image()
    {
        return $this->hasMany(ProductImage::class);
    }
}
