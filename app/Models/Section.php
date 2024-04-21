<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public function palette(){
        return $this->belongsTo(Palette::class);
    }

    public function paletteSections(){
        return $this->hasMany(PaletteSection::class);
    }
}
