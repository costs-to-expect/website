<?php

namespace App\Http\Controllers;

use App\Request\Api;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;

/**
 * Child controller
 *
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class ChildController extends BaseController
{
    /**
     * Dashboard for Jack
     *
     * @return View
     */
    public function jack(): View
    {
        $category_totals = [
            '98WLap7Bx3' => [
                'name' => 'Essential',
                'description' => 'Expenses that we consider essential in the raising a child',
                'total' => 0.00
            ],
            'RjXM5VJDw6' => [
                'name' => 'Non-Essential',
                'description' => 'Optional expenses, expenses that we consider non-essential in raising a child',
                'total' => 0.00
            ],
            'Gwg7zgL316' => [
                'name' => 'Hobbies & Interests',
                'description' => 'Leisure activities',
                'total' => 0.00
            ]
        ];

        $categories = Api::getInstance()
            ->public()
            ->get('/v1/summary/resource-types/d185Q15grY/resources/kw8gLq31VB/items?categories=true');

        if ($categories !== null) {
            foreach ($categories as $category) {
                $category_totals[$category['id']]['total'] = $category['total'];
            }
        }

        $annual_totals = [];
        for ($i = intval(date('Y')) - 2; $i <= intval(date('Y')); $i++) {
            $annual_totals[$i] = [
                'year' => $i,
                'total' => 0.00
            ];
        }

        $annual_summary = Api::getInstance()
            ->public()
            ->get('/v1/summary/resource-types/d185Q15grY/resources/kw8gLq31VB/items?years=true');

        if ($annual_summary !== null) {
            foreach ($annual_summary as $year) {
                if (array_key_exists($year['year'], $annual_totals) === true) {
                    $annual_totals[$year['year']]['total'] = $year['total'];
                }
            }
        }

        $recent_expenses = Api::getInstance()
            ->public()
            ->get('/v1/resource-types/d185Q15grY/resources/kw8gLq31VB/items?limit=25&include-categories=true&include-subcategories=true');

        $recent_expenses_headers = Api::getInstance()->previousRequestHeaders();

        $total_count = 0;
        if ($recent_expenses_headers !== null && array_key_exists('X-Total-Count', $recent_expenses_headers) === true) {
            $total_count = $recent_expenses_headers['X-Total-Count'][0];
        }
        $total = $category_totals['98WLap7Bx3']['total'] + $category_totals['RjXM5VJDw6']['total'] + $category_totals['Gwg7zgL316']['total'];

        return view(
            'jack',
            [
                'config' => $this->configProperties(),
                'menus' => $this->menus(),
                'active' => '/jack',
                'api_requests' => $this->apiRequestsForJack(),
                'category_totals' => $category_totals,
                'annual_totals' => $annual_totals,
                'recent_expenses' => $recent_expenses,
                'total_count' => $total_count,
                'total' => $total
            ]
        );
    }

    /**
     * Dashboard for Niall
     *
     * @return View
     */
    public function niall(): View
    {
        $category_totals = [
            '98WLap7Bx3' => [
                'name' => 'Essential',
                'description' => 'Expenses that we consider essential in the raising a child',
                'total' => 0.00
            ],
            'RjXM5VJDw6' => [
                'name' => 'Non-Essential',
                'description' => 'Optional expenses, expenses that we consider non-essential in raising a child',
                'total' => 0.00
            ],
            'Gwg7zgL316' => [
                'name' => 'Hobbies & Interests',
                'description' => 'Leisure activities',
                'total' => 0.00
            ]
        ];


        $categories = Api::getInstance()
            ->public()
            ->get('/v1/summary/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items?categories=true');

        if ($categories !== null) {
            foreach ($categories as $category) {
                $category_totals[$category['id']]['total'] = $category['total'];
            }
        }

        $annual_totals = [];
        for ($i = intval(date('Y')) - 2; $i <= intval(date('Y')); $i++) {
            $annual_totals[$i] = [
                'year' => $i,
                'total' => 0.00
            ];
        }

        $annual_summary = Api::getInstance()
            ->public()
            ->get('/v1/summary/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items?years=true');

        if ($annual_summary !== null) {
            foreach ($annual_summary as $year) {
                if (array_key_exists($year['year'], $annual_totals) === true) {
                    $annual_totals[$year['year']]['total'] = $year['total'];
                }
            }
        }

        $recent_expenses = Api::getInstance()
            ->public()
            ->get('/v1/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items?limit=25&include-categories=true&include-subcategories=true');

        $recent_expenses_headers = Api::getInstance()->previousRequestHeaders();

        $total_count = 0;
        if ($recent_expenses_headers !== null && array_key_exists('X-Total-Count', $recent_expenses_headers) === true) {
            $total_count = $recent_expenses_headers['X-Total-Count'][0];
        }
        $total = $category_totals['98WLap7Bx3']['total'] + $category_totals['RjXM5VJDw6']['total'] + $category_totals['Gwg7zgL316']['total'];

        return view(
            'niall',
            [
                'config' => $this->configProperties(),
                'menus' => $this->menus(),
                'active' => '/niall',
                'api_requests' => $this->apiRequestsForNiall(),
                'category_totals' => $category_totals,
                'annual_totals' => $annual_totals,
                'recent_expenses' => $recent_expenses,
                'total_count' => $total_count,
                'total' => $total
            ]
        );
    }

    /**
     * Years dashboard for Jack
     *
     * @return View
     */
    public function yearsForJack(): View
    {
        return view(
            'jack-years',
            [
                'config' => $this->configProperties(),
                'menus' => $this->menus(),
                'active' => '/jack'
            ]
        );
    }

    /**
     * Years dashboard for Niall
     *
     * @return View
     */
    public function yearsForNiall(): View
    {
        return view(
            'niall-years',
            [
                'config' => $this->configProperties(),
                'menus' => $this->menus(),
                'active' => '/niall'
            ]
        );
    }

    /**
     * Return the config properties
     *
     * @return array
     */
    private function configProperties()
    {
        return Config::get('web.app');
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

    /**
     * Return the API requests for the detail page for Jack
     *
     * @return array
     */
    private function apiRequestsForJack(): array
    {
        return [
            [
                'name' => 'Expenses by category',
                'uri' => '/summary/resource-types/d185Q15grY/resources/kw8gLq31VB/items?categories=true'
            ],
            [
                'name' => 'Expenses by year',
                'uri' => '/summary/resource-types/d185Q15grY/resources/kw8gLq31VB/items?years=true'
            ],
            [
                'name' => '25 most recent expenses',
                'uri' => '/resource-types/d185Q15grY/resources/kw8gLq31VB/items?limit=25&include-categories=true&include-subcategories=true'
            ]
        ];
    }

    /**
     * Return the API requests for the detail page for Niall
     *
     * @return array
     */
    private function apiRequestsForNiall(): array
    {
        return [
            [
                'name' => 'Expenses by category',
                'uri' => '/summary/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items?categories=true'
            ],
            [
                'name' => 'Expenses by year',
                'uri' => '/summary/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items?years=true'
            ],
            [
                'name' => '25 most recent expenses',
                'uri' => '/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items?limit=25&include-categories=true&include-subcategories=true'
            ]
        ];
    }
}
