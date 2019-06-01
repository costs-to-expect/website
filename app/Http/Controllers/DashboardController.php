<?php

namespace App\Http\Controllers;

use App\Request\Api;
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
        /**
         * Each child should a model, sub set of child model
         *
         * Need to have a method to get the API id, kw8gLq31VB etc
         */
        $children = [
            'jack' => [
                'name' => 'Jack Blackborough',
                'date_of_birth' => '28th June 2013',
                'total' => 0.00
            ],
            'niall' => [
                'name' => 'Niall Blackborough',
                'date_of_birth' => '22nd April 2019',
                'total' => 0.00
            ]
        ];

        /**
         * Need to move this code to model classes
         */
        $child_totals = Api::getInstance()
            ->public()
            ->get('/v1/summary/resource-types/d185Q15grY/items?resources=true');

        if ($child_totals !== null) {
            $children['jack']['total'] = $child_totals[0]['total'];
            $children['niall']['total'] = $child_totals[0]['total'];
        }

        return view(
            'dashboard',
            [
                'menus' => $this->menus(),
                'active' => '/',
                'meta' => [
                    'title' => 'Dashboard',
                    'description' => 'What does it cost to raise a child to adulthood in the UK?'
                ],
                'welcome' => [
                    'title' => 'What does it cost to raise a child in the UK?',
                    'description' => 'Welcome to Costs to Expect.com',
                    'image' => [
                        'icon' => 'dashboard.png',
                        'title' => 'Costs to Expect.com'
                    ]
                ],
                'children' => $children,
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
                'name' => 'Totals for children',
                'uri' => '/summary/resource-types/d185Q15grY/items?resources=true'
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
