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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('coordinates')->comment('Google maps location');
            $table->unsignedBigInteger('organizer_id')->comment('This is the organizer identifier that composes the locations');
            $table->unsignedBigInteger('created_user_id')->comment('This is the identifier of the creative user of the location (it has no relationship, it works as a bitacora)');
            $table->unsignedBigInteger('modified_user_id')->comment('This is the user identifier that modifies a location (it has no relationship, it works as a bitacora)');
            
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
        Schema::dropIfExists('locations');
    }
};
