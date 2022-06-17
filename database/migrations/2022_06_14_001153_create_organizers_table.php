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
        Schema::create('organizers', function (Blueprint $table) {
            $table->id();

            $table->string('portrait')->comment('The picture portrait path of the organizer')->nullable();
            $table->string('email')->comment('The email of the organizer');
            $table->string('phone')->comment('The phone of the organizer');
            $table->string('website')->comment('The website of the organizer')->nullable();
            $table->unsignedBigInteger('user_id')->comment('The id of the user that represents the organizer in the system')->nullable();
            $table->unsignedBigInteger('created_user_id')->comment('The id of the user who created this record')->nullable();
            $table->unsignedBigInteger('modified_user_id')->comment('The id of the user who updated this record')->nullable();
            
            
            $table->foreign('user_id')
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
        Schema::dropIfExists('organizers');
    }
};
