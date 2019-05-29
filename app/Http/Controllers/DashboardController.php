<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;

/**
 * Site dashboard
 *
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class DashboardController extends BaseController
{
    /**
     * Site welcome dashboard
     *
     * @return View
     */
    public function index(): View
    {
        return view(
            'dashboard',
            [
                'menus' => $this->menus(),
                'active' => '/',
                'meta' => [
                    'title' => 'Dashboard',
                    'description' => 'What does it costs to raise a child to adulthood in the UK?'
                ],
                'welcome' => [
                    'title' => 'Dashboard',
                    'description' => 'Welcome to Costs to Expect.com',
                    'image' => [
                        'icon' => 'dashboard.png',
                        'title' => 'Costs to Expect.com'
                    ]
                ],
                'api_requests' => $this->apiRequests()
            ]
        );
    }

    /**
     * Return the API requests for the dashboard
     *
     * @return array
     */
    private function apiRequests(): array
    {
        return [
            [
                'name' => 'Total for Jack',
                'uri' => '/v1/summary/resource-types/d185Q15grY/resources/kw8gLq31VB/items'
            ],
            [
                'name' => 'Total for Niall',
                'uri' => '/v1/summary/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items'
            ],
            [
                'name' => 'Total for the Blackborough children',
                'uri' => '/v1/summary/resource-types/d185Q15grY/items'
            ],
            [
                'name' => '2019 total for Jack',
                'uri' => '/v1/summary/resource-types/d185Q15grY/resources/kw8gLq31VB/items?years=2019'
            ],
            [
                'name' => '2019 total for Niall',
                'uri' => '/v1/summary/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items?years=2019'
            ],
            [
                'name' => '2019 total for the Blackborough children',
                'uri' => '/v1/summary/resource-types/d185Q15grY/items?year=2019'
            ],
            [
                'name' => '25 most recent expenses',
                'uri' => '/v1/resource-types/d185Q15grY/items?limit=25&show-categories=true&show-subcategories=true'
            ]
        ];
    }

    /**
     * Return the menus
     *
     * @return array
     */
    private function menus(): array
    {
        return Config::get('web.menus');
    }
}
