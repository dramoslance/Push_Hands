<?php

namespace Interface\RolePermission;

abstract class EntityBase
{
    public const GUARD_NAME_ADMIN = 'admin';
    public const GUARD_NAME_WEB = 'web';
    public const GUARD_NAME_TOKEN = 'token';

    protected static function get_elements(): array
    {
        return [];
    }
}