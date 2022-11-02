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
        'access_cp' => 'Access Control Panel',

        'read_dashboard' => 'Read Dashboard',

        'create_roles' => 'Create Roles',
        'read_roles' => 'Read Roles',
        'update_roles' => 'Update Roles',
        'delete_roles' => 'Delete Roles',

        'create_users' => 'Create Users',
        'read_users' => 'Read Users',
        'update_users' => 'Update Users',
        'delete_users' => 'Delete Users',

    ],

];
