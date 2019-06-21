<?php

namespace App\Http\Controllers;

use App\Models\Child\Jack;
use App\Models\Child\Niall;
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
        Api::resetCalledURIs();
        $jack = new Jack();
        $niall = new Niall();

        $jack_total = $jack->total();
        $niall_total = $niall->total();

        if ($jack->totalCurrentYearPopulated() === false) {
            $jack->setTotalCurrentYearApiResponse(
                Api::summaryExpensesForCurrentYear(
                    $jack->id()
                )
            );
            Api::setCalledURI('Current year expenses for ' . $jack->details()['name'], Api::lastUri());
        }

        if ($niall->totalCurrentYearPopulated() === false) {
            $niall->setTotalCurrentYearApiResponse(
                Api::summaryExpensesForCurrentYear(
                    $niall->id()
                )
            );
            Api::setCalledURI('Current year expenses for ' . $niall->details()['name'], Api::lastUri());
        }

        $jack_current_year = $jack->totalCurrentYear();
        $niall_current_year = $niall->totalCurrentYear();

        $recent_expenses = Api::recentExpensesForBothChildren();
        Api::setCalledURI('The 25 most recent expenses', Api::lastUri());

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
                'jack_total' => $jack_total,
                'niall_total' => $niall_total,
                'recent_expenses' => $recent_expenses,
                'jack_current_year' => $jack_current_year,
                'niall_current_year' => $niall_current_year,
                'api_requests' => Api::calledURIs()
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
                'name' => 'Total expenses for Jack',
                'uri' => '/v1/summary/resource-types/d185Q15grY/resources/kw8gLq31VB/items'
            ],
            [
                'name' => 'Total expenses for Niall',
                'uri' => '/v1/summary/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items'
            ],
            [
                'name' => 'Current year expenses for Jack',
                'uri' => '/v1/summary/resource-types/d185Q15grY/resources/kw8gLq31VB/items?year=2019'
            ],
            [
                'name' => 'Current year expenses for Niall',
                'uri' => '/v1/summary/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items?year=2019'
            ],
            [
                'name' => '25 most recent expenses for both children',
                'uri' => '/v1/resource-types/d185Q15grY/items?limit=25&include-categories=true&include-subcategories=true'
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
