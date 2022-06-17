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
        Schema::create('speakers_languages', function (Blueprint $table) {
            $table->id();
            
            $table->string('name')->comment('The name of the translated speaker');
            $table->string('biography')->comment('Brief biography of the speaker');
            $table->unsignedBigInteger('language_id')->comment('The language identifier that represents the translation');
            $table->unsignedBigInteger('speaker_id')->comment('The identifier of the speaker that is translated');
            $table->unsignedBigInteger('created_user_id')->comment('This is the identifier of user who creates the translation (it has no relationship, it works as a bitacora)')->nullable();
            $table->unsignedBigInteger('modified_user_id')->comment('This is the identifier of user who modifies the translation (it has no relationship, it works as a bitacora)')->nullable();

            $table
                ->foreign('language_id')
                ->references('id')
                ->on('languages');
            
            $table
                ->foreign('speaker_id')
                ->references('id')
                ->on('speakers');

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
        Schema::dropIfExists('speakers_languages');
    }
};
