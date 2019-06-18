<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Child\Annual;
use App\Models\Child\Jack;
use App\Models\Child\Niall;
use App\Models\Child\Category;
use App\Request\Api;
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
        $expense_model = new Child\Expense();

        if ($category_model->categoriesSummaryPopulated() === false) {
            $category_model->setCategoriesSummaryApiResponse(Api::summaryExpensesByCategory($child->id()));
        }

        $categories_summary = $category_model->categoriesSummary();

        if ($annual_model->annualSummaryPopulated() === false) {
            $annual_model->setAnnualSummaryApiResponse(Api::summaryExpensesAnnual($child->id()));
        }

        $annual_summary = $annual_model->annualSummary();

        if ($expense_model->recentExpensesPopulated() === false) {
            $expense_model->setRecentExpensesApiResponse(Api::recentExpenses($child->id()));
            $expense_model->setRecentExpensesApiHeaderResponse(Api::previousRequestHeaders());
        }

        $recent_expenses = $expense_model->recentExpenses();
        $number_of_expenses = $expense_model->recentExpensesHeader('X-Total-Count');

        $total = $category_model->totalFromCategorySummary();

        if ($category_model->largestEssentialExpensePopulated() === false) {
            $category_model->setLargestEssentialExpenseResponse(
                Api::largestExpenseInCategory(
                    $child->id(),
                    $category_model->essentialId()
                )
            );
        }
        if ($category_model->largestNonEssentialExpensePopulated() === false) {
            $category_model->setLargestNonEssentialExpenseResponse(
                Api::largestExpenseInCategory(
                    $child->id(),
                    $category_model->nonEssentialId()
                )
            );
        }
        if ($category_model->largestHobbyInterestExpensePopulated() === false) {
            $category_model->setLargestHobbyInterestExpenseResponse(
                Api::largestExpenseInCategory(
                    $child->id(),
                    $category_model->hobbyInterestId()
                )
            );
        }

        $largest_essential_expense = $category_model->largestEssentialExpense();
        $largest_non_essential_expense = $category_model->largestNonEssentialExpense();
        $largest_hobby_interest_expense = $category_model->largestHobbyInterestExpense();

        return view(
            'child',
            [
                'menus' => $this->menus(),
                'active' => $child->uri(),
                'meta' => [
                    'title' => $child->details()['name'],
                    'description' => 'What does it cost to raise a child to adulthood in the UK?'
                ],
                'welcome' => [
                    'title' => $child->details()['name'],
                    'description' => $child->details()['version'],
                    'image' => [
                        'icon' => 'dashboard.png',
                        'title' => 'Costs to Expect.com'
                    ]
                ],

                'api_requests' => $this->apiRequestsForChild($child->id()),

                'categories_summary' => $categories_summary,
                'annual_summary' => $annual_summary,

                'child_details' => $child->details(),

                'recent_expenses' => $recent_expenses,
                'number_of_expenses' => $number_of_expenses,
                'total' => $total,
                
                'largest_essential_expense' => $largest_essential_expense,
                'largest_non_essential_expense' => $largest_non_essential_expense,
                'largest_hobby_interest_expense' => $largest_hobby_interest_expense
            ]
        );
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
     * Return the API requests for the requested child
     *
     * @param string $child_id
     *
     * @return array
     */
    private function apiRequestsForChild(string $child_id): array
    {
        return [
            [
                'name' => 'Expenses by category',
                'uri' => 'v1/summary/resource-types/d185Q15grY/resources/' . $child_id. '/items?categories=true'
            ],
            [
                'name' => 'Expenses by year',
                'uri' => 'v1/summary/resource-types/d185Q15grY/resources/' . $child_id. '/items?years=true'
            ],
            [
                'name' => '25 most recent expenses',
                'uri' => 'v1/resource-types/d185Q15grY/resources/' . $child_id. '/items?limit=25&include-categories=true&include-subcategories=true'
            ],
            [
                'name' => 'Top Essential expense',
                'uri' => 'v1/resource-types/d185Q15grY/resources/' . $child_id. '/items?category=98WLap7Bx3&sort=actualised_total:desc&limit=1'
            ],
            [
                'name' => 'Top Non-Essential expense',
                'uri' => 'v1/resource-types/d185Q15grY/resources/' . $child_id. '/items?category=RjXM5VJDw6&sort=actualised_total:desc&limit=1'
            ],
            [
                'name' => 'Top Hobby and Interests expense',
                'uri' => 'v1/resource-types/d185Q15grY/resources/' . $child_id. '/items?category=Gwg7zgL316&sort=actualised_total:desc&limit=1'
            ],
        ];
    }
}
