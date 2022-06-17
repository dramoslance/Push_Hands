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
        Schema::create('speakers', function (Blueprint $table) {
            $table->id();

            $table->string('portrait')->comment('This is the path of the Speaker profile photo')->nullable();
            $table->integer('type')->comment('Define the type of 0: Speaker Full Week, or 1: Guest');
            $table->unsignedBigInteger('event_id')->comment('This is the event identifier');
            $table->unsignedBigInteger('user_id')->comment('This is the user identifier that is related to the speaker')->nullable();
            $table->unsignedBigInteger('created_user_id')->comment('This is the identifier of the user who creates the translation(it has no relationship, it works as a bitacora)')->nullable();
            $table->unsignedBigInteger('modified_user_id')->comment('This is the identifier of the user who modifies the translation (it has no relationship, it works as a bitacora)')->nullable();

            $table
                ->foreign('event_id')
                ->references('id')
                ->on('events');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullable();

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
        Schema::dropIfExists('speakers');
    }
};
