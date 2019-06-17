<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Child\Annual;
use App\Models\Child\Jack;
use App\Models\Child\Niall;
use App\Models\Child\Category;
use App\Request\Api;
use App\Request\Http;
use App\Request\Uri;
use Illuminate\Http\Request;
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
    private function childModel(string $uri): Child
    {
        if ($uri === '/jack') {
            return new Jack();
        } else {
            return new Niall();
        }
    }

    /**
     * Dashboard for Jack
     *
     * @param Request $request
     *
     * @return View
     */
    public function child(Request $request): View
    {
        $child = $this->childModel($request->getPathInfo());

        $category_model = new Category();
        $annual_model = new Annual();

        if ($category_model->categoriesSummaryPopulated() === false) {
            $category_model->setCategoriesSummaryApiResponse(Api::summaryExpensesByCategory($child->id()));
            $categories_summary = $category_model->categoriesSummary();
        } else {
            $categories_summary = $category_model->categoriesSummary();
        }

        if ($annual_model->annualSummaryPopulated() === false) {
            $annual_model->setAnnualSummaryApiResponse(Api::summaryExpensesAnnual($child->id()));
            $annual_summary = $annual_model->annualSummary();
        } else {
            $annual_summary = $annual_model->annualSummary();
        }

        $recent_expenses = Http::getInstance()
            ->public()
            ->get('/v1/resource-types/d185Q15grY/resources/kw8gLq31VB/items?limit=25&include-categories=true&include-subcategories=true', true);

        $recent_expenses_headers = Http::getInstance()->previousRequestHeaders();

        $total_count = 0;
        if ($recent_expenses_headers !== null && array_key_exists('X-Total-Count', $recent_expenses_headers) === true) {
            $total_count = $recent_expenses_headers['X-Total-Count'][0];
        }

        $total = $category_model->totalFromCategorySummary();

        $largest_expense = Http::getInstance()
            ->public()
            ->get('/v1/resource-types/d185Q15grY/resources/kw8gLq31VB/items?sort=actualised_total:desc&limit=1');

        return view(
            'child',
            [
                'config' => $this->configProperties(),
                'menus' => $this->menus(),
                'uri' => $child->uri(),
                'api_requests' => $this->apiRequestsForJack(),

                'categories_summary' => $categories_summary,
                'annual_summary' => $annual_summary,

                'child_details' => $child->details(),

                'recent_expenses' => $recent_expenses,
                'total_count' => $total_count,
                'total' => $total,
                'largest_expense' => $largest_expense
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


        $categories = Request::getInstance()
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

        $annual_summary = Request::getInstance()
            ->public()
            ->get('/v1/summary/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items?years=true');

        if ($annual_summary !== null) {
            foreach ($annual_summary as $year) {
                if (array_key_exists($year['year'], $annual_totals) === true) {
                    $annual_totals[$year['year']]['total'] = $year['total'];
                }
            }
        }

        $recent_expenses = Request::getInstance()
            ->public()
            ->get('/v1/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items?limit=25&include-categories=true&include-subcategories=true', true);

        $recent_expenses_headers = Request::getInstance()->previousRequestHeaders();

        $total_count = 0;
        if ($recent_expenses_headers !== null && array_key_exists('X-Total-Count', $recent_expenses_headers) === true) {
            $total_count = $recent_expenses_headers['X-Total-Count'][0];
        }
        $total = $category_totals['98WLap7Bx3']['total'] + $category_totals['RjXM5VJDw6']['total'] + $category_totals['Gwg7zgL316']['total'];

        $largest_expense = Request::getInstance()
            ->public()
            ->get('/v1/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items?sort=actualised_total:desc&limit=1');

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
                'total' => $total,
                'largest_expense' => $largest_expense
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
            ],
            [
                'name' => 'Largest expense',
                'uri' => '/resource-types/d185Q15grY/resources/kw8gLq31VB/items?sort=actualised_total:desc&limit=1'
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
            ],
            [
                'name' => 'Largest expense',
                'uri' => '/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items?sort=actualised_total:desc&limit=1'
            ]
        ];
    }
}
