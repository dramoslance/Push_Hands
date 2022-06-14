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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();

            $table->string('type')->comment('Type of activity');
            $table->string('start_time')->comment('Activity start time');
            $table->string('end_time')->comment('Time of finalization of the activity');
            $table->unsignedBigInteger('event_id')->comment('This is the event identifier');
            $table->unsignedBigInteger('created_user_id')->comment('This is the identifier of the activitie creative user (it has no relationship, it works as a bitacora)')->nullable();
            $table->unsignedBigInteger('modified_user_id')->comment('This is the user identifier that modifies a activitie (it has no relationship, it works as a bitacora)')->nullable();

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
        Schema::dropIfExists('activities');
    }
};
