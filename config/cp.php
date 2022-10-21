<?php

return [

    'menu_items' => [
        'dashboard' => [
            'title' => 'Dashboard',
            'url' => '/cp/dashboard',
        ],
        'administration' => [
            'title' => 'Administration',
            'children' => [
                'roles' => [
                    'url' => '/cp/roles',
                    'title' => 'Roles',
                ],
                'users' => [
                    'url' => '/cp/users',
                    'title' => 'Users',
                ],
            ],
        ],
    ],

    'permissions' => [
        'access_cp',

        'read_dashboard',

        'create_roles',
        'read_roles',
        'update_roles',
        'delete_roles',

        'create_users',
        'read_users',
        'update_users',
        'delete_users',

    ],

];
