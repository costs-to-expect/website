<?php

declare(strict_types=1);

return [
    'children' => [
        'title' => 'The Blackborough Children',
        'items' => [
            [
                'name' => 'Dashboard',
                'title' => 'Costs to Expect Dashboard',
                'icon' => 'icon-dashboard',
                'uri' => '/'
            ],
            [
                'name' => 'Jack',
                'title' => 'Dashboard for Jack',
                'icon' => 'icon-dashboard',
                'uri' => '/jack'
            ],
            [
                'name' => 'Niall',
                'title' => 'Dashboard for Niall',
                'icon' => 'icon-dashboard',
                'uri' => '/niall'
            ]
        ]
    ],
    'site' => [
        'title' => 'Costs to Expect',
        'items' => [
            [
                'name' => 'About',
                'title' => 'What is Costs to Expect?',
                'icon' => null,
                'uri' => '/about'
            ],
            [
                'name' => 'What we count?',
                'title' => 'How do we arrive at the figures',
                'icon' => null,
                'uri' => '/what-we-count'
            ],
            [
                'name' => 'Changelog',
                'title' => 'Costs to Expect Changelog',
                'icon' => null,
                'uri' => '/changelog'
            ]
        ]
    ]
];
