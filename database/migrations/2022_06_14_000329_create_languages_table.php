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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();

            $table->string('name')->comment('The name of the language');
            $table->string('iso_code')->comment('The iso standard code for the language');
            $table->unsignedBigInteger('created_user_id')->comment('The id of the user who created this record')->nullable();
            $table->unsignedBigInteger('modified_user_id')->comment('The id of the user who updated this record')->nullable();

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
        Schema::dropIfExists('languages');
    }
};
