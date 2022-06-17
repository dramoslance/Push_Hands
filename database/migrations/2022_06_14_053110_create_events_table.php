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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->string('banner')->comment('The picture banner path of the event')->nullable();
            $table->string('slug')->comment('This is the friendly way to show the event for URL/SEO.');
            $table->timestamp('start_time')->comment('This is the Event start time')->useCurrent();
            $table->timestamp('end_time')->comment('This is the Event termination time')->useCurrent();
            $table->boolean('highlighted')->comment('define if an event is highlighted among others')->default(false);
            $table->string('timezone')->comment('This is the time zone in which the event is located');
            $table->integer('status')->comment('Let us know if an event is in the following states: 0 = draft,1 = published')->default(0);
            $table->unsignedBigInteger('organizer_id')->comment('The organizer identifier to whom the event belongs');
            $table->unsignedBigInteger('location_id')->comment('The Location identifier of the event event');
            $table->unsignedBigInteger('cluster_id')->comment('The cluster identifier that groups the event');
            $table->unsignedBigInteger('event_id')->comment('"The identifier of the father event, that is, when an event is organized in a recurring way.The father event will have null value in this field')->nullable();
            $table->unsignedBigInteger('created_user_id')->comment('The id of the user who creates an event')->nullable();
            $table->unsignedBigInteger('modified_user_id')->comment('The id of the user who modifies an event')->nullable();

            $table
                ->foreign('organizer_id')
                ->references('id')
                ->on('organizers');

            $table
                ->foreign('location_id')
                ->references('id')
                ->on('locations');
            
            $table
                ->foreign('cluster_id')
                ->references('id')
                ->on('clusters');
            
            $table
                ->foreign('event_id')
                ->references('id')
                ->on('events')
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
        Schema::dropIfExists('events');
    }
};
