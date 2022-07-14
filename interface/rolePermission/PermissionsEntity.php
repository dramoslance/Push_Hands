<?php

namespace Interface\RolePermission;

class PermissionsEntity extends EntityBase
{
    // permission super admin
    public const ADMIN_ALL = 'admin_all';

    // permission admin
    public const ADMIN_READ = 'admin_read';
    public const ADMIN_WRITE = 'admin_write';
    public const ADMIN_EXECUTE = 'admin_execute';

    // permission user
    public const USER_READ = 'user_read';
    public const USER_WRITE = 'user_write';
    public const USER_EXECUTE = 'user_execute';

    public static function get_elements(): array
    {
        $array = [
            ['guard_name' => self::GUARD_NAME_API, 'name' => self::ADMIN_ALL],
            ['guard_name' => self::GUARD_NAME_API, 'name' => self::ADMIN_READ],
            ['guard_name' => self::GUARD_NAME_API, 'name' => self::ADMIN_WRITE],
            ['guard_name' => self::GUARD_NAME_API, 'name' => self::ADMIN_EXECUTE],
            ['guard_name' => self::GUARD_NAME_API, 'name' => self::USER_READ],
            ['guard_name' => self::GUARD_NAME_API, 'name' => self::USER_WRITE],
            ['guard_name' => self::GUARD_NAME_API, 'name' => self::USER_EXECUTE],
        ];

        return $array;
    }

    public static function permission_find(string $name): bool
    {
        if (in_array($name, self::array_entity(self::get_elements()))) {
            return true;
        }

        return false;
    }
}