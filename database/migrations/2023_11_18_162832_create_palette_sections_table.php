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
        Schema::create('palette_sections', function (Blueprint $table) {
            $table->integer('section_id')->nullable();
            $table->integer('palette_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('img_id')->nullable();
            $table->float('qty')->nullable();
            $table->string('unit')->nullable();
            $table->float('new_rate')->nullable();
            $table->float('order')->nullable();
            $table->string('comment')->nullable();
            $table->string('override_category')->nullable();
            $table->timestamps();

            // Define composite primary key
            $table->primary(['section_id', 'img_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('palette_sections');
    }
};
