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
        Schema::create('clusters_languages', function (Blueprint $table) {
            $table->id();

            $table->string('name')->comment('The name of the category of the translated event');
            $table->string('slug')->comment('"This is the name friendly to be used in the translated URL');
            $table->string('description')->comment('This is the description of the category of the translated event');
            $table->unsignedBigInteger('cluster_id')->comment('Cluster identifier that translates');
            $table->unsignedBigInteger('langauge_id')->comment('Language identifier to which it is translated');
            $table->unsignedBigInteger('created_user_id')->comment('The id of the user who creates the translation')->nullable();
            $table->unsignedBigInteger('modified_user_id')->comment('The id of the user who updates the translation')->nullable();

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
        Schema::dropIfExists('clusters_languages');
    }
};
