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
        Schema::table('password_resets', function (Blueprint $table) {
            $table->dropColumn('created_at');
        });

        Schema::table('password_resets', function (Blueprint $table) {
            $table->id()->first();
            $table->string('old_password')->after('email')->nullable();
            $table->enum('status', ['PENDING', 'CHANGED', 'CANCEL'])->after('token')->default('PENDING');
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
        if (Schema::hasColumn('password_resets', 'id')) {
            Schema::table('password_resets', function (Blueprint $table) {

                $table->dropColumn(
                    [
                        'id',
                        'old_password',
                        'status',
                        'updated_at',
                    ]
                );
            });
        }
    }
};