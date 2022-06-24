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
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->comment('The identifier of the user member');
            $table->unsignedBigInteger('organizer_id')->comment('The identifier of the organizer');
            $table->unsignedBigInteger('created_user_id')->comment('The identifier of the user creating the member')->nullable();
            $table->unsignedBigInteger('modified_user_id')->comment('The identifier of the user modifying the member')->nullable();

            $table->unique(['user_id','organizer_id']);

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
        Schema::dropIfExists('members');
    }
};
