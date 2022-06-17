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
        Schema::create('clusters', function (Blueprint $table) {
            $table->id();

            $table->string('slug')->comment('This is the name friendly to be used in the URL');
            $table->string('main_image_url')->comment('This is the main image that identifies the category of the event')->nullable();
            $table->unsignedBigInteger('created_user_id')->comment('The id of the user who creates the cluster')->nullable();
            $table->unsignedBigInteger('modified_user_id')->comment('The id of the user who updates the cluster')->nullable();

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
        Schema::dropIfExists('clusters');
    }
};
