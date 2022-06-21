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
        //

        Schema::table('speakers', function (Blueprint $table) {
            
            $table->unsignedBigInteger('instructor_id')->comment('This is the identifier that represents the instructor that will be talking in a event.');
            
            $table->foreign('instructor_id')
                ->references('id')
                ->on('instructors');

        });


        if (Schema::hasColumn('speakers', 'user_id'))     
        {
            Schema::table('speakers', function (Blueprint $table) {
            
                $table->dropForeign('speakers_user_id_foreign');
                $table->dropColumn('user_id');

            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //


        Schema::table('speakers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->comment('This is the user identifier that is related to the speaker')->nullable();
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullable();
        });

        if (Schema::hasColumn('speakers', 'instructor_id')){
            
            Schema::table('speakers', function (Blueprint $table) {
                            
                $table->dropForeign('speakers_instructor_id_foreign');
                $table->dropColumn('instructor_id');

            });

        }

    }
};
