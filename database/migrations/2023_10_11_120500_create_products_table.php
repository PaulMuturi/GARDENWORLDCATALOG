<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('botanical_name')->nullable();
            $table->string('common_name')->nullable();
            $table->string('image')->nullable();
            $table->string('category')->nullable();
            $table->float('selling_price')->nullable();
            $table->float('max_discounted_price')->nullable();
            $table->float('boq_price')->nullable();
            $table->float('stocked_qty')->nullable();
            $table->string('stocked_qty_units')->nullable();
            $table->text('notes')->nullable();
            $table->string('publish')->nullable();
            $table->string('foliage_color')->nullable();
            $table->string('flower_color')->nullable();
            $table->string('maintenance')->nullable();
            $table->float('planting_interval')->nullable();
            $table->string('planting_interval_units')->nullable();
            $table->float('mature_spread')->nullable();
            $table->string('mature_spread_units')->nullable();
            $table->float('mature_height')->nullable();
            $table->string('mature_height_units')->nullable();
            $table->string('water_requirements')->nullable();
            $table->string('toxicity_to_humans')->nullable();
            $table->string('toxicity_to_pets')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
