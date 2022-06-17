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
        Schema::create('organizers_languages', function (Blueprint $table) {
            $table->id();

            $table->string('name')->comment('The translated name of the organizer');
            $table->string('description')->comment('The translated description of the organizer');
            $table->unsignedBigInteger('language_id')->comment('The id of the language to translate');
            $table->unsignedBigInteger('organizer_id')->comment('The id of the organizer to be translated');
            $table->unsignedBigInteger('created_user_id')->comment('The id of the user who creates the translation')->nullable();
            $table->unsignedBigInteger('modified_user_id')->comment('The id of the user who updates the translation')->nullable();

            $table
                ->foreign('language_id')
                ->references('id')
                ->on('languages');
            
            $table
                ->foreign('organizer_id')
                ->references('id')
                ->on('organizers');

            
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
        Schema::dropIfExists('organizers_languages');
    }
};
