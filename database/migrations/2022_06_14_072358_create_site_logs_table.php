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
        Schema::create('site_logs', function (Blueprint $table) {
            $table->id();

            $table->timestamp('start_time')->comment('The time in which entry into the log is created');
            $table->timestamp('end_time')->comment('The time in which a user leaves an event or activity');
            $table->string('event_id')->comment('This is the identifier of the event to which the entry into the log is associated')->nullable();
            $table->string('activity_id')->comment('This is the identifier of the activity to which the entry into the log is associated')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_logs');
    }
};
