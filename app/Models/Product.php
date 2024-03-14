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

    public function foliage_color()
    {
        return $this->hasMany(FoliageColor::class);
    }

    public function flower_color()
    {
        return $this->hasMany(FlowerColor::class);
    }

    public function general_color()
    {
        return $this->hasMany(GeneralColor::class);
    }

    public function gardentype()
    {
        return $this->hasMany(Gardentype::class);
    }
    public function categories()
    {
        return $this->hasMany(ProductCategory::class);
    }
}
