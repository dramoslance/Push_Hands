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
        Schema::create('activities_languages', function (Blueprint $table) {
            $table->id();

            $table->string('name')->comment('Name of translated activity');
            $table->string('description')->comment('Description of the translated activity');
            $table->unsignedBigInteger('language_id')->comment('The language identifier that represents the translation');
            $table->unsignedBigInteger('activity_id')->comment('This is the identifier of the activity to be translated');
            $table->unsignedBigInteger('created_user_id')->comment('This is the identifier of the translation user (it has no relationship, it works as a biting)')->nullable();
            $table->unsignedBigInteger('modified_user_id')->comment('This is the identifier of the translation user (it has no relationship, it works as a biting)')->nullable();

            $table
                ->foreign('language_id')
                ->references('id')
                ->on('languages');
            
            $table
                ->foreign('activity_id')
                ->references('id')
                ->on('activities');

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
        Schema::dropIfExists('activities_languages');
    }
};
