<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Child\Annual;
use App\Models\Child\Expense;
use App\Models\Child\Jack;
use App\Models\Child\Niall;
use App\Models\Child\Overview;
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
    /**
     * @var Overview
     */
    private $overview_model;
    /**
     * @var Annual
     */
    private $annual_model;
    /**
     * @var Expense
     */
    private $expense_model;

    private function childModel(string $name): Child
    {
        if ($name === 'niall') {
            return new Niall();
        } else {
            return new Jack();
        }
    }

    protected function setOverviewModel()
    {
        $this->overview_model = new Overview();
    }

    protected function setAnnualModel()
    {
        $this->annual_model = new Annual();
    }

    protected function setExpenseModel()
    {
        $this->expense_model = new Expense();
    }

    protected function categoriesSummary($child_id)
    {
        if ($this->overview_model->categoriesSummaryPopulated() === false) {
            $this->overview_model->setCategoriesSummaryApiResponse(Api::summaryExpensesByCategory($child_id));
            Api::setCalledURI('Expenses summary by category', Api::lastUri());
        }

        return [
            'summary' => $this->overview_model->categoriesSummary(),
            'total' => $this->overview_model->totalFromCategorySummary()
        ];
    }

    protected function annualSummary($child_id)
    {
        if ($this->annual_model->annualSummaryPopulated() === false) {
            $this->annual_model->setAnnualSummaryApiResponse(Api::summaryExpensesAnnual($child_id));
            Api::setCalledURI('Expenses summary by year', Api::lastUri());
        }

        return $this->annual_model->annualSummary();
    }

    protected function recentExpenses($child_id)
    {
        if ($this->expense_model->recentExpensesPopulated() === false) {
            $this->expense_model->setRecentExpensesApiResponse(Api::recentExpenses($child_id));
            $this->expense_model->setRecentExpensesApiHeaderResponse(Api::previousRequestHeaders());
            Api::setCalledURI('The 25 most recent expenses', Api::lastUri());
        }

        return
            [
                'expenses' => $this->expense_model->recentExpenses(),
                'total' => $this->expense_model->recentExpensesHeader('X-Total-Count')
            ];
    }

    protected function largestEssentialExpense($child_id)
    {
        if ($this->overview_model->largestEssentialExpensePopulated() === false) {
            $this->overview_model->setLargestEssentialExpenseResponse(
                Api::largestExpenseInCategory(
                    $child_id,
                    $this->overview_model->essentialId()
                )
            );
            Api::setCalledURI('The top Essential expense', Api::lastUri());
        }

        return $this->overview_model->largestEssentialExpense();
    }

    protected function largestNonEssentialExpense($child_id)
    {
        if ($this->overview_model->largestNonEssentialExpensePopulated() === false) {
            $this->overview_model->setLargestNonEssentialExpenseResponse(
                Api::largestExpenseInCategory(
                    $child_id,
                    $this->overview_model->nonEssentialId()
                )
            );
            Api::setCalledURI('The top Non-Essential expense', Api::lastUri());
        }

        return $this->overview_model->largestNonEssentialExpense();
    }

    protected function largestHobbyInterestExpense($child_id)
    {
        if ($this->overview_model->largestHobbyInterestExpensePopulated() === false) {
            $this->overview_model->setLargestHobbyInterestExpenseResponse(
                Api::largestExpenseInCategory(
                    $child_id,
                    $this->overview_model->hobbyInterestId()
                )
            );
            Api::setCalledURI('The top Hobbies and Interests expense', Api::lastUri());
        }

        return $this->overview_model->largestHobbyInterestExpense();
    }

    public function jack()
    {
        return $this->child('jack');
    }

    public function niall()
    {
        return $this->child('niall');
    }

    /**
     * Overview page for each child
     *
     * @param string $child
     *
     * @return View
     */
    public function child($child): View
    {
        Api::resetCalledURIs();

        $this->setOverviewModel();
        $this->setAnnualModel();
        $this->setExpenseModel();

        $child = $this->childModel($child);

        $categories_summary_data = $this->categoriesSummary($child->id());
        $categories_summary = $categories_summary_data['summary'];
        $total = $categories_summary_data['total'];

        $annual_summary = $this->annualSummary($child->id());

        $recent_expenses_data = $this->recentExpenses($child->id());
        $recent_expenses = $recent_expenses_data['expenses'];
        $number_of_expenses = $recent_expenses_data['total'];

        $largest_essential_expense = $this->largestEssentialExpense($child->id());
        $largest_non_essential_expense = $this->largestNonEssentialExpense($child->id());
        $largest_hobby_interest_expense = $this->largestHobbyInterestExpense($child->id());

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
     * @param string $child
     * @param string $category_name
     *
     * @return View
     */
    public function category(Request $request, string $child, string $category_name): View
    {
        Api::resetCalledURIs();

        $this->setOverviewModel();
        $this->setExpenseModel();

        $child = $this->childModel($child);

        $categories_summary_data = $this->categoriesSummary($child->id());
        $categories_summary = $categories_summary_data['summary'];
        $total = $categories_summary_data['total'];

        $recent_expenses_data = $this->recentExpenses($child->id());
        $recent_expenses = $recent_expenses_data['expenses'];
        $number_of_expenses = $recent_expenses_data['total'];

        $largest_essential_expense = $this->largestEssentialExpense($child->id());
        $largest_non_essential_expense = $this->largestNonEssentialExpense($child->id());
        $largest_hobby_interest_expense = $this->largestHobbyInterestExpense($child->id());

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
