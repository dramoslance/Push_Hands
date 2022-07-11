<?php

namespace Database\Seeders;

// use Carbon\Factory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\Factory\RunSeeder as FactorySeeder;
use Database\Seeders\RolePermission\RunSeeder as RolePermissionSeeder;
use Database\Seeders\Auth\RunSeeder as AuthSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolePermissionSeeder::class,
            AuthSeeder::class,
        ]);

        env('APP_ENV') === 'local' && $this->call(FactorySeeder::class);
        // env('APP_ENV') === 'production' && $this->call([]);
    }
}