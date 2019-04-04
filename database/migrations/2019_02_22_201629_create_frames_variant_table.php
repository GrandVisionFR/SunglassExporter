<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFramesVariantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frames_variant', function (Blueprint $table) {
            $table->increments('id');
            $table->text('catalog_version')->nullable();
            $table->text('code')->nullable();
            $table->text('base_product')->nullable();
            $table->text('sapid')->nullable();
            $table->text('online_date')->nullable();
            $table->text('offline_date')->nullable();
            $table->text('synergie_name_fr')->nullable();
            $table->text('macro_univers')->nullable();
            $table->text('supercategories')->nullable();
            $table->text('frame_incontournable')->nullable();
            $table->text('description_fr')->nullable();
            $table->text('caliber_size')->nullable();
            $table->text('frame_web_colour')->nullable();
            $table->text('ean')->nullable();
            $table->text('promo_stickers')->nullable();
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
        Schema::dropIfExists('frames_variant');
    }
}
