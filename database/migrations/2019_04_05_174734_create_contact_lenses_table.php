<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactLensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_lenses', function (Blueprint $table) {
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
            $table->text('shape')->nullable();
            $table->text('gender')->nullable();
            $table->text('age_group')->nullable();
            $table->text('custom_label_0')->nullable();
            $table->text('custom_label_1')->nullable();
            $table->text('custom_label_2')->nullable();
            $table->text('custom_label_3')->nullable();
            $table->text('custom_label_4')->nullable();
            $table->text('catalog_version')->nullable();
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
        Schema::dropIfExists('contact_lenses');
    }
}
