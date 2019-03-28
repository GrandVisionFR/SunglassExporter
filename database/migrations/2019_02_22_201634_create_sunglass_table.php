<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSunglassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sunglass', function (Blueprint $table) {
            $table->increments('sunglass_id');
            $table->string('sunglass_catalog_version')->nullable();
            $table->string('sunglass_code')->nullable();
            $table->string('sunglass_sapid')->nullable();
            $table->string('sunglass_online_date')->nullable();
            $table->string('sunglass_offline_date')->nullable();
            $table->string('sunglass_synergie_name_fr')->nullable();
            $table->string('sunglass_frame_genre')->nullable();
            $table->string('sunglass_description_fr')->nullable();
            $table->string('sunglass_age_range')->nullable();
            $table->string('sunglass_frame_material')->nullable();
            $table->string('sunglass_frame_model')->nullable();
            $table->string('sunglass_frame_shape')->nullable();
            $table->string('sunglass_frame_mounting')->nullable();
            $table->string('sunglass_nose_size')->nullable();
            $table->string('sunglass_brand_name')->nullable();
            $table->string('sunglass_promo_stickers')->nullable();
            $table->string('sunglass_temple_length')->nullable();
            $table->string('sunglass_lens_protection_index')->nullable();
            $table->index('sunglass_code');
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
        Schema::dropIfExists('sunglass');
    }
}
