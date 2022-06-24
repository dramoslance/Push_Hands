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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('location_id')->comment('This is the identifier of the location that represents the staff list');
            $table->unsignedBigInteger('instructor_id')->comment('This is the identifier of the instructor that represents the staff list');
            $table->unsignedBigInteger('created_user_id')->comment('This is the id of the user that creates the staff in the system')->nullable();
            $table->unsignedBigInteger('modified_user_id')->comment('This is the id of the user that updates the staff in the system')->nullable();

            $table
                ->foreign('instructor_id')
                ->references('id')
                ->on('instructors');

            $table
                ->foreign('location_id')
                ->references('id')
                ->on('locations');

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
        Schema::dropIfExists('staff');
    }
};
