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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            
            $table->string('grade')->comment('This is the academic grade of the instructor')->nullable();
            $table->unsignedBigInteger('user_id')->comment('This is the id of the user that identifies the instructor in the system');
            $table->unsignedBigInteger('created_user_id')->comment('This is the id of the user that creates the instructor in the system')->nullable();
            $table->unsignedBigInteger('modified_user_id')->comment('This is the id of the user that updates the instructor in the system')->nullable();


            $table->foreign('user_id')
                ->references('id')
                ->on('users');

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
        Schema::dropIfExists('instructors');
    }
};
