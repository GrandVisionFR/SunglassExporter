<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSunglassVariantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sunglass_variant', function (Blueprint $table) {
            $table->increments('sunglass_variant_id');
            $table->text('sunglass_variant_catalog_version')->nullable();
            $table->text('sunglass_variant_code')->nullable();
            $table->text('sunglass_variant_base_product')->nullable();
            $table->text('sunglass_variant_sapid')->nullable();
            $table->text('sunglass_variant_online_date')->nullable();
            $table->text('sunglass_variant_offline_date')->nullable();
            $table->text('sunglass_variant_synergie_name_fr')->nullable();
            $table->text('sunglass_variant_macro_univers')->nullable();
            $table->text('sunglass_variant_supercategories')->nullable();
            $table->text('sunglass_variant_frame_incontournable')->nullable();
            $table->text('sunglass_variant_description_fr')->nullable();
            $table->text('sunglass_variant_caliber_size')->nullable();
            $table->text('sunglass_variant_frame_web_colour')->nullable();
            $table->text('sunglass_variant_ean')->nullable();
            $table->text('sunglass_variant_promo_stickers')->nullable();
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
        Schema::dropIfExists('sunglass_variant');
    }
}
