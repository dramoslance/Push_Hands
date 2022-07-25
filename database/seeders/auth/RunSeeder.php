<?php

namespace Database\Seeders\Auth;

use Illuminate\Database\Seeder;

class RunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SuperAdminSeeder::class);
        env('CREATE_USER_ADMIN_SEEDER') && $this->call(AdminSeeder::class);
    }
}