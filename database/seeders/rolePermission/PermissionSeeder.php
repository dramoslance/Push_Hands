<?php

namespace Database\Seeders\RolePermission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Interface\RolePermission\PermissionsEntity;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (PermissionsEntity::get_elements() as $key => $permission) {
            Permission::create($permission);
        }
    }
}