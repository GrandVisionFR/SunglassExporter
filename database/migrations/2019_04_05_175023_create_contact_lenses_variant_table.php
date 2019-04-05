<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactLensesVariantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_lenses_variant', function (Blueprint $table) {
            $table->increments('id');
            $table->string('catalog_version')->nullable();
            $table->string('code')->nullable();
            $table->string('base_product')->nullable();
            $table->string('sapid')->nullable();
            $table->string('online_date')->nullable();
            $table->string('offline_date')->nullable();
            $table->string('synergie_name_fr')->nullable();
            $table->string('description_fr')->nullable();
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
        Schema::dropIfExists('contact_lenses_variant');
    }
}
