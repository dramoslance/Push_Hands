<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\Local\PermissionSeeder;
use Database\Seeders\Local\RoleSeeder;
use Database\Seeders\Local\RoleHasPermissionSeeder;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            RoleHasPermissionSeeder::class,
        ]);
    }
}