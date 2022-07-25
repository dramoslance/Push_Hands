<?php

namespace Interface\RolePermission;

abstract class EntityBase
{
    public const GUARD_NAME_API = 'api';
    public const GUARD_NAME_WEB = 'web';
    public const GUARD_NAME_TOKEN = 'token';

    protected static function get_elements(): array
    {
        return [];
    }

    protected static function array_entity(array $elements): array
    {
        $newElements = [];
        foreach ($elements as $element) {
            array_push($newElements, $element['name']);
        }

        return $newElements;
    }
}