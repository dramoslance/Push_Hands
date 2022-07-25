<?php

namespace Database\Seeders\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Interface\RolePermission\PermissionsEntity;
use Interface\RolePermission\RolesEntity;
use Codedungeon\PHPCliColors\Color;
use Carbon\Carbon;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_env_user = [
            'ADMIN_NAME' => env('ADMIN_NAME'),
            'ADMIN_LASTNAME' => env('ADMIN_LASTNAME'),
            'ADMIN_EMAIL' => env('ADMIN_EMAIL'),
            'ADMIN_USERNAME' => env('ADMIN_USERNAME'),
            'ADMIN_PASSWORD' => env('ADMIN_PASSWORD'),
        ];

        if (in_array(false, $data_env_user)) {
            echo Color::RED, 'Error: ', Color::WHITE, '  Admin data missing.', PHP_EOL;
            return;
        }

        $admin = User::create([
            'name' => $data_env_user['ADMIN_NAME'],
            'lastname' => $data_env_user['ADMIN_LASTNAME'],
            'birth_date' => Carbon::now(),
            'email' => $data_env_user['ADMIN_EMAIL'],
            'username' => $data_env_user['ADMIN_USERNAME'],
            'password' => Hash::make($data_env_user['ADMIN_PASSWORD']),
            'email_verified_at' => Carbon::now(),
        ]);

        $admin->assignRole(RolesEntity::ADMIN);
        $admin->givePermissionTo(PermissionsEntity::ADMIN_READ);
        $admin->givePermissionTo(PermissionsEntity::ADMIN_WRITE);
        $admin->givePermissionTo(PermissionsEntity::ADMIN_EXECUTE);
        echo Color::GREEN, 'Success: ', Color::WHITE, 'Registered admin user.', PHP_EOL;
    }
}