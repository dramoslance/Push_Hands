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
            ['guard_name' => self::GUARD_NAME_ADMIN, 'name' => self::SUPER_ADMIN],
            ['guard_name' => self::GUARD_NAME_ADMIN, 'name' => self::ADMIN],
            ['guard_name' => self::GUARD_NAME_WEB, 'name' => self::USER],
        ];

        return $array;
    }
}