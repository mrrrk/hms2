<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Main Navigation
    |--------------------------------------------------------------------------
    |
    | Multi-level navigation array
    | Only two levels currently implemented in view
    |
    */
    'main' => [
        'home' => [
            'text'          => 'Home',
            'route'         => 'index',
            'permissions'   => [],
            'links'         => [],
        ],
        'projects' => [
            'text'          => 'Projects',
            'route'         => 'projects.index',
            'match'         => 'projects.index',
            'permissions'   => ['project.view.self'],
            'links'         => [],
        ],
        'boxes' => [
            'text'          => 'Boxes',
            'route'         => 'boxes.index',
            'match'         => 'boxes.index',
            'permissions'   => ['box.view.self'],
            'links'         => [],
        ],
        'snackspaceTransactions' => [
            'text'          => 'Snackspace',
            'route'         => 'snackspace.transactions.index',
            'match'         => 'snackspace.transactions.index',
            'permissions'   => ['snackspace.transaction.view.self'],
            'links'         => [],
        ],
        'tools' => [
            'text'          => 'Tools',
            'route'         => 'tools.index',
            'match'         => 'tools.index',
            'permissions'   => ['tools.view'],
            'links'         => [],
        ],
        'teams' => [
            'text'          => 'Teams',
            'route'         => 'teams.index',
            'permissions'   => ['team.view'],
            'links'         => [],
        ],
        'codes' => [
            'text'          => 'Access Codes',
            'route'         => 'accessCodes',
            'permissions'   => ['accessCodes.view'],
            'links'         => [],
        ],
        'links' => [
            'text'          => 'Links',
            'route'         => 'links.index',
            'match'         => 'links.index',
            'permissions'   => [],
            'links'         => [],
        ],
        'vending' => [
            'text'          => 'Vending',
            'permissions'   => [],
            'links'         => [
                'vendingMachines'          => [
                    'text'          => 'Machines',
                    'route'         => 'snackspace.vending-machines.index',
                    'match'         => 'snackspace.vending-machines.index',
                    'permissions'   => ['snackspace.vendingMachine.view'],
                    'links'         => [],
                ],
                'products'      => [
                    'text'          => 'Products',
                    'route'         => 'snackspace.products.index',
                    'match'         => 'snackspace.products.index',
                    'permissions'   => ['snackspace.product.view'],
                    'links'         => [],
                ],
            ],
        ],
        'admin' => [
            'text'          => 'Admin',
            'permissions'   => [],
            'links'         => [
                // 'dashboard'         => [
                //     'text'          => 'Dashboard',
                //     'route'         => 'admin',
                //     'match'         => 'admin',
                //     'permissions'   => ['profile.view.all'],
                //     'links'         => [],
                // ],
                // 'user'         => [
                //     'text'          => 'Members',
                //     'route'         => 'users.index',
                //     'match'         => 'users.index',
                //     'permissions'   => ['profile.view.all'],
                //     'links'         => [],
                // ],
                'roles'         => [
                    'text'          => 'Roles',
                    'route'         => 'roles.index',
                    'match'         => 'roles.index',
                    'permissions'   => ['role.view.all'],
                    'links'         => [],
                ],
                'meta'          => [
                    'text'          => 'Meta',
                    'route'         => 'metas.index',
                    'match'         => 'metas.index',
                    'permissions'   => ['meta.view'],
                    'links'         => [],
                ],
                'labels'          => [
                    'text'          => 'Label Templates',
                    'route'         => 'labels.index',
                    'match'         => 'labels.index',
                    'permissions'   => ['labelTemplate.view'],
                    'links'         => [],
                ],
                'joinAccounts' => [
                    'text'          => 'Join Accounts',
                    'route'         => 'banking.accounts.listJoint',
                    'match'         => 'banking.accounts.listJoint',
                    'permissions'   => ['profile.view.limited', 'profile.view.all'],
                    'links'         => [],
                ],
                'bankTransactions' => [
                    'text'          => 'Reconcile Bank Transaction',
                    'route'         => 'bank-transactions.unmatched',
                    'match'         => 'bank-transactions.unmatched',
                    'permissions'   => ['bankTransactions.reconcile'],
                    'links'         => [],
                ],
                'inviteSearch' => [
                    'text'          => 'Resend Invite',
                    'route'         => 'admin.invites',
                    'permissions'   => ['search.invites'],
                    'links'         => [],
                ],
                'horizon'          => [
                    'text'          => 'Horizon',
                    'route'         => 'horizon.index',
                    'match'         => 'horizon.index',
                    'permissions'   => ['horizon.view'],
                    'links'         => [],
                ],
            ],
        ],
    ],
];
