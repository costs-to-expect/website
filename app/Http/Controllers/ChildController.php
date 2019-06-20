<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Child\Annual;
use App\Models\Child\Expense;
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
        $bits = explode('/',  $uri);

        if (array_key_exists(1, $bits) && $bits[1] === 'jack') {
            return new Jack();
        } else {
            return new Niall();
        }
    }

    /**
     * Overview page for each child
     *
     * @param Request $request
     *
     * @return View
     */
    public function child(Request $request): View
    {
        Api::resetCalledURIs();
        $child = $this->childModel($request->getPathInfo());

        $category_model = new Category();
        $annual_model = new Annual();
        $expense_model = new Expense();

        if ($category_model->categoriesSummaryPopulated() === false) {
            $category_model->setCategoriesSummaryApiResponse(Api::summaryExpensesByCategory($child->id()));
            Api::setCalledURI('Expenses summary by category', Api::lastUri());
        }

        $categories_summary = $category_model->categoriesSummary();

        if ($annual_model->annualSummaryPopulated() === false) {
            $annual_model->setAnnualSummaryApiResponse(Api::summaryExpensesAnnual($child->id()));
            Api::setCalledURI('Expenses summary by year', Api::lastUri());
        }

        $annual_summary = $annual_model->annualSummary();

        if ($expense_model->recentExpensesPopulated() === false) {
            $expense_model->setRecentExpensesApiResponse(Api::recentExpenses($child->id()));
            $expense_model->setRecentExpensesApiHeaderResponse(Api::previousRequestHeaders());
            Api::setCalledURI('The 25 most recent expenses', Api::lastUri());
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
            Api::setCalledURI('The top Essential expense', Api::lastUri());
        }
        if ($category_model->largestNonEssentialExpensePopulated() === false) {
            $category_model->setLargestNonEssentialExpenseResponse(
                Api::largestExpenseInCategory(
                    $child->id(),
                    $category_model->nonEssentialId()
                )
            );
            Api::setCalledURI('The top Non-Essential expense', Api::lastUri());
        }
        if ($category_model->largestHobbyInterestExpensePopulated() === false) {
            $category_model->setLargestHobbyInterestExpenseResponse(
                Api::largestExpenseInCategory(
                    $child->id(),
                    $category_model->hobbyInterestId()
                )
            );
            Api::setCalledURI('The top Hobbies and Interests expense', Api::lastUri());
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

                'api_requests' => Api::calledURIs(),

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
     * Categories overview page for each child
     *
     * @param Request $request
     * @param string $category_name
     *
     * @return View
     */
    public function category(Request $request, string $category_name): View
    {
        Api::resetCalledURIs();
        $child = $this->childModel($request->getPathInfo());

        $category_model = new Category();
        $annual_model = new Annual();
        $expense_model = new Expense();

        if ($category_model->categoriesSummaryPopulated() === false) {
            $category_model->setCategoriesSummaryApiResponse(Api::summaryExpensesByCategory($child->id()));
            Api::setCalledURI('Expenses summary by category', Api::lastUri());
        }

        $categories_summary = $category_model->categoriesSummary();

        if ($annual_model->annualSummaryPopulated() === false) {
            $annual_model->setAnnualSummaryApiResponse(Api::summaryExpensesAnnual($child->id()));
            Api::setCalledURI('Expenses summary by year', Api::lastUri());
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
            Api::setCalledURI('The top Essential expense', Api::lastUri());
        }
        if ($category_model->largestNonEssentialExpensePopulated() === false) {
            $category_model->setLargestNonEssentialExpenseResponse(
                Api::largestExpenseInCategory(
                    $child->id(),
                    $category_model->nonEssentialId()
                )
            );
            Api::setCalledURI('The top Non-Essential expense', Api::lastUri());
        }
        if ($category_model->largestHobbyInterestExpensePopulated() === false) {
            $category_model->setLargestHobbyInterestExpenseResponse(
                Api::largestExpenseInCategory(
                    $child->id(),
                    $category_model->hobbyInterestId()
                )
            );
            Api::setCalledURI('The top Hobbies and Interests expense', Api::lastUri());
        }

        $largest_essential_expense = $category_model->largestEssentialExpense();
        $largest_non_essential_expense = $category_model->largestNonEssentialExpense();
        $largest_hobby_interest_expense = $category_model->largestHobbyInterestExpense();

        return view(
            'child-category',
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

                'api_requests' => Api::calledURIs(),

                'categories_summary' => $categories_summary,

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
}
