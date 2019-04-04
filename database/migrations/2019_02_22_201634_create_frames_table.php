<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFramesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frames', function (Blueprint $table) {
            $table->increments('id');
            $table->string('catalog_version')->nullable();
            $table->string('code')->nullable();
            $table->string('sapid')->nullable();
            $table->string('online_date')->nullable();
            $table->string('offline_date')->nullable();
            $table->string('synergie_name_fr')->nullable();
            $table->string('frame_genre')->nullable();
            $table->string('description_fr')->nullable();
            $table->string('age_range')->nullable();
            $table->string('frame_material')->nullable();
            $table->string('frame_model')->nullable();
            $table->string('frame_shape')->nullable();
            $table->string('frame_mounting')->nullable();
            $table->string('nose_size')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('promo_stickers')->nullable();
            $table->string('temple_length')->nullable();
            $table->string('lens_protection_index')->nullable();
            $table->index('code');
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
        Schema::dropIfExists('frames');
    }
}
