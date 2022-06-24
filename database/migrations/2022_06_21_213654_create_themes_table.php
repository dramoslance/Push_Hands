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
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            
            $table->string('name')->comment('This is the name of the theme');
            $table->boolean('is_default')->comment('This is the identifier of the default theme, true=default');
            $table->unsignedBigInteger('entity_id')->comment('This is the identifier of the entity');
            $table->string('entity_name')->comment('This is the name of entity');
            $table->unsignedBigInteger('created_user_id')->comment('The identifier of the user creating the theme')->nullable();
            $table->unsignedBigInteger('modified_user_id')->comment('The identifier of the user modifying the theme')->nullable();

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
        Schema::dropIfExists('themes');
    }
};
