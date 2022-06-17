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
        Schema::create('events_languages', function (Blueprint $table) {
            $table->id();

            $table->string('name')->comment('The name of the translated event');
            $table->string('short_name')->comment('Short name of the event to show translated');
            $table->string('tagline')->comment('The slogan of the translated event');
            $table->string('slug')->comment('This is the friendly way to show the event for URL/SEO.');
            $table->unsignedBigInteger('language_id')->comment('The language identifies that represents the translation');
            $table->unsignedBigInteger('event_id')->comment('The identifies of the event that is translated');
            $table->unsignedBigInteger('created_user_id')->comment('This is the identifies of the translation user (it has no relationship, it works as a bitacora)')->nullable();
            $table->unsignedBigInteger('modified_user_id')->comment('This is the identifies of the translation user (it has no relationship, it works as a bitacora)')->nullable();

            $table
                ->foreign('language_id')
                ->references('id')
                ->on('languages');
            
            $table
                ->foreign('event_id')
                ->references('id')
                ->on('events');

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
        Schema::dropIfExists('events_languages');
    }
};
