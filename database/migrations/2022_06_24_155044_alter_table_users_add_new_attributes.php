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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('password');
        });

        Schema::table('users', function (Blueprint $table) {

            $table->string('lastname')
                ->after('name')
                ->comment('This is the users last name');

            $table->string('username')
                ->after('lastname')
                ->unique()
                ->comment('This is the username of the user')
                ->nullable();

            $table->timestamp('birth_date')
                ->after('username')
                ->comment('This is the users date of birth');

            $table->string('portrait')
                ->after('username')
                ->comment('This is the users cover photo')
                ->nullable();

            $table->string('password')
                ->after('email')
                ->nullable();

            $table->unsignedBigInteger('created_user_id')
                ->after('remember_token')
                ->comment('This is the identifier of the user who creates the translation(it has no relationship, it works as a bitacora)')
                ->nullable();

            $table->unsignedBigInteger('modified_user_id')
                ->after('created_user_id')
                ->comment('This is the identifier of the user who modifies the translation (it has no relationship, it works as a bitacora)')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'lastname')) {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn(
                    [
                        'lastname',
                        'username',
                        'birth_date',
                        'portrait',
                        'password',
                        'created_user_id',
                        'modified_user_id'
                    ]
                );
            });

            Schema::table('users', function (Blueprint $table) {
                $table->string('password')
                    ->after('email_verified_at');
            });
        }
    }
};
