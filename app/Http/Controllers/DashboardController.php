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
         * Each child should be a model?, sub set of child model
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

        $jack_current_year = Api::getInstance()
            ->public()
            ->get('/v1/summary/resource-types/d185Q15grY/resources/kw8gLq31VB/items?year=' . date('Y'));

        $niall_current_year = Api::getInstance()
            ->public()
            ->get('/v1/summary/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items?year=' . date('Y'));

        /**
         * To to return a specific response type, or call a model method directly to sort data, optional,
         * could just return json
         */

        if ($child_totals !== null) {
            $children['jack']['total'] = $child_totals[0]['total'];
            $children['niall']['total'] = $child_totals[1]['total'];
        }

        $recent_expenses = Api::getInstance()
            ->public()
            ->get('/v1/resource-types/d185Q15grY/items?limit=25&include-categories=true&include-subcategories=true');

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
                    'title' => 'Cost to raise a child?',
                    'description' => 'Welcome to Costs to Expect.com',
                    'image' => [
                        'icon' => 'dashboard.png',
                        'title' => 'Costs to Expect.com'
                    ]
                ],
                'children' => $children,
                'recent_expenses' => $recent_expenses,
                'jack_current_year' => $jack_current_year,
                'niall_current_year' => $niall_current_year,
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
                'name' => 'Total expenses to date',
                'uri' => '/summary/resource-types/d185Q15grY/items?resources=true'
            ],
            [
                'name' => 'Current year expenses for Jack',
                'uri' => '/summary/resource-types/d185Q15grY/resources/kw8gLq31VB/items?year=2019'
            ],
            [
                'name' => 'Current year expenses for Niall',
                'uri' => '/summary/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items?year=2019'
            ],
            [
                'name' => '25 most recent expenses for both children',
                'uri' => '/resource-types/d185Q15grY/items?limit=25&include-categories=true&include-subcategories=true'
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
