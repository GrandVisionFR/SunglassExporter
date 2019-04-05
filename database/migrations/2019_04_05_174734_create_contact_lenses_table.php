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
            $table->increments('id');
            $table->string('catalog_version')->nullable();
            $table->string('code')->nullable();
            $table->string('sapid')->nullable();
            $table->string('online_date')->nullable();
            $table->string('offline_date')->nullable();
            $table->string('synergie_name_fr')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('lens_colour')->nullable();
            $table->string('lens_type')->nullable();
            $table->string('vision_type')->nullable();
            $table->string('contact_supplier')->nullable();
            $table->string('contact_duration')->nullable();
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
