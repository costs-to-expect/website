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
                'icon' => 'icon-expenses',
                'uri' => '/jack'
            ],
            [
                'name' => 'Niall',
                'title' => 'Dashboard for Niall',
                'icon' => 'icon-expenses',
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
            ],
            [
                'name' => 'Privacy policy',
                'title' => 'Our privacy policy',
                'icon' => null,
                'uri' => '/privacy-policy'
            ],
            [
                'name' => 'The App (In alpha)',
                'title' => 'The Costs to Expect App',
                'icon' => null,
                'uri' => 'https://app.costs-to-expect.com'
            ],
            [
                'name' => 'The API',
                'title' => 'The Costs to Expect API',
                'icon' => null,
                'uri' => 'https://api.costs-to-expect.com'
            ],
            [
                'name' => 'Our Blog',
                'title' => 'The Costs to Expect Blog',
                'icon' => null,
                'uri' => 'https://blog.costs-to-expect.com'
            ]
        ]
    ]
];
