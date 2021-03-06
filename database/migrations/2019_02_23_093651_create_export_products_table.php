<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExportProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_products', function (Blueprint $table) {
            $table->increments('pk');
            $table->text('id')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('price')->nullable();
            $table->text('sale_price')->nullable();
            $table->text('sale_price_effective_date')->nullable();
            $table->text('link')->nullable();
            $table->text('condition')->nullable();
            $table->text('product_type')->nullable();
            $table->text('brand')->nullable();
            $table->text('gtin')->nullable();
            $table->text('image_link')->nullable();
            $table->text('google_product_category')->nullable();
            $table->text('shipping')->nullable();
            $table->text('availability')->nullable();
            $table->text('material')->nullable();
            $table->text('color')->nullable();
            $table->text('size')->nullable();
            $table->text('age_group')->nullable();
            $table->text('gender')->nullable();
            $table->text('promosticker')->nullable();
            $table->text('excluded_destination')->nullable();
            $table->text('export_type')->nullable();
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
        Schema::dropIfExists('export_products');
    }
}
