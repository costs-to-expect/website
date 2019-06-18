<?php

namespace App\Http\Controllers;

use App\Models\Child\Jack;
use App\Models\Child\Niall;
use App\Request\Api;
use App\Request\Http;
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
        $jack_model = new Jack();
        $niall_model = new Niall();

        if ($jack_model->totalPopulated() === false) {
            $jack_model->setTotalApiResponse(
                Api::summaryExpenses(
                    $jack_model->id()
                )
            );
        }

        if ($niall_model->totalPopulated() === false) {
            $niall_model->setTotalApiResponse(
                Api::summaryExpenses(
                    $niall_model->id()
                )
            );
        }

        $jack_total = $jack_model->total();
        $niall_total = $niall_model->total();

        if ($jack_model->totalCurrentYearPopulated() === false) {
            $jack_model->setTotalCurrentYearApiResponse(
                Api::summaryExpensesForCurrentYear(
                    $jack_model->id()
                )
            );
        }

        if ($niall_model->totalCurrentYearPopulated() === false) {
            $niall_model->setTotalCurrentYearApiResponse(
                Api::summaryExpensesForCurrentYear(
                    $niall_model->id()
                )
            );
        }

        $jack_current_year = $jack_model->totalCurrentYear();
        $niall_current_year = $niall_model->totalCurrentYear();

        $recent_expenses = Http::getInstance()
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
                'jack_total' => $jack_total,
                'niall_total' => $niall_total,
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
