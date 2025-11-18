<?php

return [

    'use_morph_map' => false,

    'checkers' => [
        'default' => 'gate',
    ],

    'cache' => [
        'enabled' => false,
        'store' => 'default',
        'key' => 'laratrust_cache',
        'ttl' => 60,
    ],

    'teams' => [
        'enabled' => false,
        'strict_check' => false,
        'teams_middleware' => [
            'enabled' => false,
        ],
    ],

    'middleware' => [
        'role' => 'role',
        'permission' => 'permission',
        'ability' => 'ability',
        'team' => null,
    ],

    'models' => [
        'role' => App\Role::class,
        'permission' => App\Permission::class,
        'user' => App\User::class,
    ],

    'tables' => [
        'roles' => 'roles',
        'permissions' => 'permissions',
        'role_user' => 'role_user',
        'permission_role' => 'permission_role',
        'permission_user' => 'permission_user',
    ],

    'foreign_keys' => [
        'role' => 'role_id',
        'permission' => 'permission_id',
        'user' => 'user_id',
    ],

];

