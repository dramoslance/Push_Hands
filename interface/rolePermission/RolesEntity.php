<?php

namespace Interface\RolePermission;

class RolesEntity extends EntityBase
{
    public const SUPER_ADMIN = 'super_admin';
    public const ADMIN = 'admin';
    public const USER = 'user';

    public static function get_elements(): array
    {
        $array = [
            ['guard_name' => self::GUARD_NAME_API, 'name' => self::SUPER_ADMIN],
            ['guard_name' => self::GUARD_NAME_API, 'name' => self::ADMIN],
            ['guard_name' => self::GUARD_NAME_API, 'name' => self::USER],
        ];

        return $array;
    }

    public static function role_find(string $name): bool
    {
        if (in_array($name, self::array_entity(self::get_elements()))) {
            return true;
        }

        return false;
    }
}