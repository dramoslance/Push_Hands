<?php

namespace Database\Seeders\Auth;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Interface\RolePermission\PermissionsEntity;
use Interface\RolePermission\RolesEntity;
use Codedungeon\PHPCliColors\Color;

use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_env_user = [
            'SUPER_ADMIN_NAME' => env('SUPER_ADMIN_NAME'),
            'SUPER_ADMIN_LASTNAME' => env('SUPER_ADMIN_LASTNAME'),
            'SUPER_ADMIN_EMAIL' => env('SUPER_ADMIN_EMAIL'),
            'SUPER_ADMIN_USERNAME' => env('SUPER_ADMIN_USERNAME'),
            'SUPER_ADMIN_PASSWORD' => env('SUPER_ADMIN_PASSWORD'),
        ];

        if (in_array(false, $data_env_user)) {
            echo Color::RED, 'Error: ', Color::WHITE, '  Super admin data missing.', PHP_EOL;
            return;
        }

        $admin = User::create([
            'name' => $data_env_user['SUPER_ADMIN_NAME'],
            'lastname' => $data_env_user['SUPER_ADMIN_LASTNAME'],
            'birth_date' => Carbon::now(),
            'email' => $data_env_user['SUPER_ADMIN_EMAIL'],
            'username' => $data_env_user['SUPER_ADMIN_USERNAME'],
            'password' => bcrypt($data_env_user['SUPER_ADMIN_PASSWORD']),
            'email_verified_at' => Carbon::now(),
        ]);

        $admin->assignRole(RolesEntity::SUPER_ADMIN);
        echo Color::GREEN, 'Success: ', Color::WHITE, 'Registered super admin user.', PHP_EOL;

        $admin->givePermissionTo(PermissionsEntity::ADMIN_ALL);
        $admin->givePermissionTo(PermissionsEntity::ADMIN_READ);
        $admin->givePermissionTo(PermissionsEntity::ADMIN_WRITE);
        $admin->givePermissionTo(PermissionsEntity::ADMIN_EXECUTE);

        $admin->givePermissionTo(PermissionsEntity::USER_READ);
        $admin->givePermissionTo(PermissionsEntity::USER_WRITE);
        $admin->givePermissionTo(PermissionsEntity::USER_EXECUTE);
    }
}