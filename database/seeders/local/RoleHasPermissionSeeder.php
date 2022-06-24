<?php

namespace Database\Seeders\Local;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

use Interface\RolePermission\PermissionsEntity;
use Interface\RolePermission\RolesEntity;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** -----------------------------------------------------------------------------------------------
         * Find roles.
         * ------------------------------------------------------------------------------------------------*/

        $role_super_admin = Role::findByName(RolesEntity::SUPER_ADMIN, RolesEntity::GUARD_NAME_ADMIN);
        $role_admin = Role::findByName(RolesEntity::ADMIN, RolesEntity::GUARD_NAME_ADMIN);
        $role_user = Role::findByName(RolesEntity::USER, RolesEntity::GUARD_NAME_WEB);

        /** -----------------------------------------------------------------------------------------------
         * Assign permissions to roles.
         * ------------------------------------------------------------------------------------------------*/

        // role super admin.
        $role_super_admin->givePermissionTo(PermissionsEntity::ADMIN_ALL);
        $role_super_admin->givePermissionTo(PermissionsEntity::ADMIN_READ);
        $role_super_admin->givePermissionTo(PermissionsEntity::ADMIN_WRITE);
        $role_super_admin->givePermissionTo(PermissionsEntity::ADMIN_EXECUTE);

        // role admin.
        $role_admin->givePermissionTo(PermissionsEntity::ADMIN_READ);
        $role_admin->givePermissionTo(PermissionsEntity::ADMIN_WRITE);
        $role_admin->givePermissionTo(PermissionsEntity::ADMIN_EXECUTE);

        // role user.
        $role_user->givePermissionTo(PermissionsEntity::USER_WRITE);
        $role_user->givePermissionTo(PermissionsEntity::USER_READ);
        $role_user->givePermissionTo(PermissionsEntity::USER_EXECUTE);

        // ----------------------------------------------------------------------------------------------- //

    }
}