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

    protected function annualSummary($child_id)
    {
        if ($this->annual_model->annualSummaryPopulated() === false) {
            $this->annual_model->setAnnualSummaryApiResponse(Api::summaryExpensesAnnual($child_id));
            Api::setCalledURI('Expenses summary by year', Api::lastUri());
        }

        return $this->annual_model->annualSummary();
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

        $overview = new Overview();
        $expense = new Expense();
        $child = $this->childModel($child);

        $this->setAnnualModel();

        $categories_summary_data = $overview->categoriesSummary($child->id());
        $categories_summary = $categories_summary_data['summary'];
        $total = $categories_summary_data['total'];

        $annual_summary = $this->annualSummary($child->id());

        $largest_essential_expense = $overview->largestEssentialExpense($child->id());
        $largest_non_essential_expense = $overview->largestNonEssentialExpense($child->id());
        $largest_hobby_interest_expense = $overview->largestHobbyInterestExpense($child->id());

        $recent_expenses_data = $expense->recentExpenses($child->id());
        $recent_expenses = $recent_expenses_data['expenses'];
        $number_of_expenses = $recent_expenses_data['total'];

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
     * @param string $category_uri
     *
     * @return View
     */
    public function category(Request $request, string $child, string $category_uri): View
    {
        Api::resetCalledURIs();

        $overview = new Overview();
        $expense = new Expense();

        $this->setExpenseModel();

        $child = $this->childModel($child);
        $category_model = Child\Category::modelByUriSlug($category_uri);

        $categories_summary_data = $overview->categoriesSummary($child->id());
        $categories_summary = $categories_summary_data['summary'];
        $total = $categories_summary_data['total'];

        $subcategories_summary = $category_model->subcategorySummary($child->id(), $category_model->id());

        $largest_essential_expense = $overview->largestEssentialExpense($child->id());
        $largest_non_essential_expense = $overview->largestNonEssentialExpense($child->id());
        $largest_hobby_interest_expense = $overview->largestHobbyInterestExpense($child->id());

        $recent_expenses_data = $expense->recentExpensesByCategory($child->id(), $category_model->id());
        $recent_expenses = $recent_expenses_data['expenses'];
        $number_of_expenses = $recent_expenses_data['total'];

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
                    'title' => $child->details()['name'] . ': ' . $category_model->name() . ' expenses' ,
                    'description' => 'Overview of all the ' . $category_model->name() . ' expenses',
                    'image' => [
                        'icon' => 'dashboard.png',
                        'title' => 'Costs to Expect.com'
                    ]
                ],

                'api_requests' => Api::calledURIs(),

                'categories_summary' => $categories_summary,
                'subcategories_summary' =>$subcategories_summary,

                'child_details' => $child->details(),

                'active_category_id' => $category_model->id(),
                'active_category_name' => $category_model->name(),
                'active_category_uri_slug' => $category_model->uriSlug(),

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
     * Subcategories overview page for each child
     *
     * @param Request $request
     * @param string $child
     * @param string $category_uri
     * @param string $subcategory_id
     *
     * @return View
     */
    public function subcategory(Request $request, string $child, string $category_uri, string $subcategory_id): View
    {
        Api::resetCalledURIs();

        $overview = new Overview();
        $expense = new Expense();

        $this->setExpenseModel();

        $child = $this->childModel($child);
        $category_model = Child\Category::modelByUriSlug($category_uri);
        $subcategory_model = new Child\Subcategory();

        $categories_summary_data = $overview->categoriesSummary($child->id());
        $categories_summary = $categories_summary_data['summary'];
        $total = $categories_summary_data['total'];

        $subcategories_summary = $category_model->subcategorySummary($child->id(), $category_model->id());

        $subcategory = $subcategory_model->subcategory($category_model->id(), $subcategory_id);
        if ($subcategory === null) {
            redirect('/');
        }

        $largest_essential_expense = $overview->largestEssentialExpense($child->id());
        $largest_non_essential_expense = $overview->largestNonEssentialExpense($child->id());
        $largest_hobby_interest_expense = $overview->largestHobbyInterestExpense($child->id());

        $recent_expenses_data = $expense->recentExpensesBySubcategory(
            $child->id(),
            $category_model->id(),
            $subcategory_id
        );
        $recent_expenses = $recent_expenses_data['expenses'];
        $number_of_expenses = $recent_expenses_data['total'];

        return view(
            'child-subcategory',
            [
                'menus' => $this->menus(),
                'active' => $child->uri(),
                'meta' => [
                    'title' => $child->details()['name'],
                    'description' => 'What does it cost to raise a child to adulthood in the UK?'
                ],
                'welcome' => [
                    'title' => $child->details()['name'] . ': ' .
                        $category_model->name() . '/' . $subcategory['name'] . ' expenses' ,
                    'description' => 'Overview of all the ' .
                        $category_model->name() . '/' . $subcategory['name'] . ' expenses',
                    'image' => [
                        'icon' => 'dashboard.png',
                        'title' => 'Costs to Expect.com'
                    ]
                ],

                'api_requests' => Api::calledURIs(),

                'categories_summary' => $categories_summary,
                'subcategories_summary' =>$subcategories_summary,

                'child_details' => $child->details(),

                'active_category_id' => $category_model->id(),
                'active_category_name' => $category_model->name(),
                'active_category_uri_slug' => $category_model->uriSlug(),

                'active_subcategory_id' => $subcategory_id,
                'active_subcategory_name' => $subcategory['name'],

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
