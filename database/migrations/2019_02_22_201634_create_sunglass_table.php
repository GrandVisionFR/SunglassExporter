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
            $table->text('sunglass_catalog_version')->nullable();
            $table->text('sunglass_code')->nullable();
            $table->text('sunglass_sapid')->nullable();
            $table->text('sunglass_online_date')->nullable();
            $table->text('sunglass_offline_date')->nullable();
            $table->text('sunglass_synergie_name_fr')->nullable();
            $table->text('sunglass_frame_genre')->nullable();
            $table->text('sunglass_description_fr')->nullable();
            $table->text('sunglass_age_range')->nullable();
            $table->text('sunglass_frame_material')->nullable();
            $table->text('sunglass_frame_model')->nullable();
            $table->text('sunglass_frame_shape')->nullable();
            $table->text('sunglass_frame_mounting')->nullable();
            $table->text('sunglass_nose_size')->nullable();
            $table->text('sunglass_brand_name')->nullable();
            $table->text('sunglass_ean')->nullable();
            $table->text('sunglass_promo_stickers')->nullable();
            $table->text('sunglass_temple_length')->nullable();
            $table->text('sunglass_lens_protection_index')->nullable();
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
