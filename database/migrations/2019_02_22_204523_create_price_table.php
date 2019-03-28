<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price', function (Blueprint $table) {
            $table->increments('price_id');
            $table->string('price_catalog_version')->nullable();
            $table->string('price_product')->nullable();
            $table->string('price_start_time')->nullable();
            $table->string('price_end_time')->nullable();
            $table->string('price_original_price')->nullable();
            $table->string('price_price')->nullable();
            $table->timestamps();
            $table->index(['price_catalog_version', 'price_product']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price');
    }
}
