<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations_languages', function (Blueprint $table) {
            $table->id();

            $table->string('name')->comment('Translated location name');
            $table->string('description')->comment('Description of the translated location');
            $table->string('address_line')->comment('physical address of the transmised location');
            $table->unsignedBigInteger('location_id')->comment('The id of the location to be translated');
            $table->unsignedBigInteger('language_id')->comment('The id of the language to translate');
            $table->unsignedBigInteger('created_user_id')->comment('The id of the user who creates the translation')->nullable();
            $table->unsignedBigInteger('modified_user_id')->comment('The id of the user who updates the translation')->nullable();

            $table
                ->foreign('location_id')
                ->references('id')
                ->on('locations');

             $table
                ->foreign('language_id')
                ->references('id')
                ->on('languages');            
            $table->softDeletes();

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
        Schema::dropIfExists('locations_languages');
    }
};
