<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Child\Annual;
use App\Models\Child\Category;
use App\Models\Child\Expense;
use App\Models\Child\Jack;
use App\Models\Child\Niall;
use App\Models\Child\Overview;
use App\Models\Child\Subcategory;
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
     * Instantiate the correct child model
     *
     * @param string $name
     *
     * @return Child
     */
    private function childModel(string $name): Child
    {
        if ($name === 'niall') {
            return new Niall();
        } else {
            return new Jack();
        }
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

        $overview_model = new Overview();
        $expense_model = new Expense();
        $annual_model = new Annual();

        $child_model = $this->childModel($child);

        $categories_summary_data = $overview_model->categoriesSummary($child_model->id());
        $categories_summary = $categories_summary_data['summary'];

        $total = $child_model->total();
        $total_number_of_expenses = $child_model->totalNumberOfExpenses();

        $annual_summary = $annual_model->annualSummary($child_model->id());

        $largest_essential_expense = $overview_model->largestEssentialExpense($child_model->id());
        $largest_non_essential_expense = $overview_model->largestNonEssentialExpense($child_model->id());
        $largest_hobby_interest_expense = $overview_model->largestHobbyInterestExpense($child_model->id());

        $recent_expenses_data = $expense_model->recentExpenses($child_model->id());
        $recent_expenses = $recent_expenses_data['expenses'];
        $number_of_expenses = $recent_expenses_data['total'];

        return view(
            'child',
            [
                'menus' => $this->menus(),
                'active' => $child_model->uri(),
                'meta' => [
                    'title' => $child_model->details()['name'],
                    'description' => 'What does it cost to raise a child to adulthood in the UK?'
                ],
                'welcome' => [
                    'title' => $child_model->details()['name'],
                    'description' => $child_model->details()['version'],
                    'image' => [
                        'icon' => 'dashboard.png',
                        'title' => 'Costs to Expect.com'
                    ]
                ],

                'api_requests' => Api::calledURIs(),

                'categories_summary' => $categories_summary,
                'annual_summary' => $annual_summary,

                'child_details' => $child_model->details(),

                'recent_expenses' => $recent_expenses,
                'number_of_expenses' => $number_of_expenses,

                'total' => $total['total'],
                'total_number_of_expenses' => $total_number_of_expenses,
                
                'largest_essential_expense' => $largest_essential_expense,
                'largest_non_essential_expense' => $largest_non_essential_expense,
                'largest_hobby_interest_expense' => $largest_hobby_interest_expense
            ]
        );
    }

    public function setExpensesFilter(Request $request, string $child)
    {
        $params = request()->all();

        $filter_params = [];

        if (array_key_exists('category', $params) === true && strlen(trim($params['category'])) === 10) {
            $filter_params['category'] = trim($params['category']);
        }
        if (array_key_exists('subcategory', $params) === true && strlen(trim($params['subcategory'])) === 10) {
            $filter_params['subcategory'] = trim($params['subcategory']);
        }
        if (array_key_exists('year', $params) === true && intval($params['year']) !== 0) {
            $filter_params['year'] = intval($params['year']);
        }
        if (array_key_exists('month', $params) === true && intval($params['month']) !== 0) {
            $filter_params['month'] = intval($params['month']);
        }

        $url = $params['child'] . '/expenses?offset=' . $params['offset'] . '&limit=' . $params['limit'];
        foreach ($filter_params as $param => $value) {
            $url .= '&' . $param . '=' . $value;
        }
        $url .= '#expenses-table';

        return redirect()->to($url, 303);
    }

    /**
     * Filterable and searchable expenses view for each child
     *
     * @param Request $request
     * @param string $child
     *
     * @return View
     */
    public function expenses(Request $request, string $child): View
    {
        Api::resetCalledURIs();

        $overview_model = new Overview();
        $expense_model = new Expense();
        $category_model = new Category();

        $child_model = $this->childModel($child);

        $offset = (int) request()->get('offset', 0);
        $limit = (int) request()->get('limit', 50);
        $category_id = request()->get('category');
        $subcategory_id = request()->get('subcategory');
        $year = request()->get('year');
        $month = request()->get('month');

        $subcategories = [];
        if ($category_id !== null) {
            $selected_category_model = Category::modelById($category_id);
            $subcategories = $selected_category_model->subcategories($category_id);
        }

        $years = $child_model->years();
        $months = $overview_model->months();

        $total = $child_model->total();
        $total_number_of_expenses = $child_model->totalNumberOfExpenses();

        $largest_essential_expense = $overview_model->largestEssentialExpense($child_model->id());
        $largest_non_essential_expense = $overview_model->largestNonEssentialExpense($child_model->id());
        $largest_hobby_interest_expense = $overview_model->largestHobbyInterestExpense($child_model->id());

        $filter_parameters = [];
        if ($category_id !== null) {
            $filter_parameters['category'] = $category_id;

            if ($subcategory_id !== null) {
                $filter_parameters['subcategory'] = $subcategory_id;
            }
        }
        if ($year !== null) {
            $filter_parameters['year'] = $year;

            if ($month !== null) {
                $filter_parameters['month'] = $month;
            }
        }

        $filter_parameters_string = '';
        foreach ($filter_parameters as $parameter => $value) {
            $filter_parameters_string .= '&' . $parameter . '=' . $value;
        }

        $expenses_data = $expense_model->expenses(
            $child_model->id(),
            $offset,
            $limit,
            $category_id,
            $subcategory_id,
            (int) $year,
            (int) $month
        );

        $base_uri = $uri = $child_model->uri() . '/expenses?limit=' . $limit . '&offset=' . $offset;
        $named_anchor = '#expenses-table';
        $assigned_filter_uris = [
            'category' => null,
            'subcategory' => null,
            'year' => null,
            'month' => null,
        ];
        if ($category_id !== null) {
            $params = [];
            if ($year !== null) {
                $params['year'] = $year;
            }
            if ($month !== null) {
                $params['month'] = $month;
            }

            $uri = $base_uri;
            foreach ($params as $param => $value) {
                $uri .= '&' . $param . '=' . $value;
            }
            $assigned_filter_uris['category'] = $uri . $named_anchor;
        }
        if ($subcategory_id !== null) {
            $params = [];
            if ($category_id !== null) {
                $params['category'] = $category_id;
            }
            if ($year !== null) {
                $params['year'] = $year;
            }
            if ($month !== null) {
                $params['month'] = $month;
            }

            $uri = $base_uri;
            foreach ($params as $param => $value) {
                $uri .= '&' . $param . '=' . $value;
            }
            $assigned_filter_uris['subcategory'] = $uri . $named_anchor;
        }
        if ($year !== null) {
            $params = [];
            if ($category_id !== null) {
                $params['category'] = $category_id;
            }
            if ($subcategory_id !== null) {
                $params['subcategory'] = $subcategory_id;
            }

            $uri = $base_uri;
            foreach ($params as $param => $value) {
                $uri .= '&' . $param . '=' . $value;
            }
            $assigned_filter_uris['year'] = $uri . $named_anchor;
        }
        if ($month !== null) {
            $params = [];
            if ($category_id !== null) {
                $params['category'] = $category_id;
            }
            if ($subcategory_id !== null) {
                $params['subcategory'] = $subcategory_id;
            }
            if ($year !== null) {
                $params['year'] = $year;
            }

            $uri = $base_uri;
            foreach ($params as $param => $value) {
                $uri .= '&' . $param . '=' . $value;
            }
            $assigned_filter_uris['month'] = $uri . $named_anchor;
        }

        return view(
            'child-expenses',
            [
                'menus' => $this->menus(),
                'active' => $child_model->uri(),
                'meta' => [
                    'title' => $child_model->details()['name'],
                    'description' => 'What does it cost to raise a child to adulthood in the UK?'
                ],
                'welcome' => [
                    'title' => $child_model->details()['name'] . ': All expenses' ,
                    'description' => 'All expenses for ' . $child_model->details()['name'],
                    'image' => [
                        'icon' => 'dashboard.png',
                        'title' => 'Costs to Expect.com'
                    ]
                ],

                'api_requests' => Api::calledURIs(),

                'child_details' => $child_model->details(),

                'total' => $total['total'],
                'total_number_of_expenses' => $total_number_of_expenses,

                'expenses' => $expenses_data['expenses'],

                'filters' => [
                    'category' => [
                        'values' => $category_model->allCategories(),
                        'set' => $category_id
                    ],
                    'subcategory' => [
                        'values' => $subcategories,
                        'set' => $subcategory_id
                    ],
                    'year' => [
                        'values' => $years,
                        'set' => $year
                    ],
                    'month' => [
                        'values' => $months,
                        'set' => $month
                    ]
                ],

                'assigned_filter_uris' => $assigned_filter_uris,

                'pagination' => [
                    'uri' => [
                        'base' => $child_model->uri() . '/expenses',
                        'parameters' => $filter_parameters_string
                    ],
                    'total' => $expenses_data['total'],
                    'offset' => $expenses_data['offset'],
                    'limit' => $expenses_data['limit']
                ],

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

        $overview_model = new Overview();
        $expense_model = new Expense();

        $child_model = $this->childModel($child);
        $category_model = Category::modelById($category_uri);

        $categories_summary_data = $overview_model->categoriesSummary($child_model->id());
        $categories_summary = $categories_summary_data['summary'];

        $total = $child_model->total();
        $total_number_of_expenses = $child_model->totalNumberOfExpenses();

        $subcategories_summary = $category_model->subcategorySummary($child_model->id(), $category_model->id());

        $largest_essential_expense = $overview_model->largestEssentialExpense($child_model->id());
        $largest_non_essential_expense = $overview_model->largestNonEssentialExpense($child_model->id());
        $largest_hobby_interest_expense = $overview_model->largestHobbyInterestExpense($child_model->id());

        $recent_expenses_data = $expense_model->recentExpensesByCategory($child_model->id(), $category_model->id());
        $recent_expenses = $recent_expenses_data['expenses'];
        $number_of_expenses = $recent_expenses_data['total'];

        return view(
            'child-category',
            [
                'menus' => $this->menus(),
                'active' => $child_model->uri(),
                'meta' => [
                    'title' => $child_model->details()['name'],
                    'description' => 'What does it cost to raise a child to adulthood in the UK?'
                ],
                'welcome' => [
                    'title' => $child_model->details()['name'] . ': ' . $category_model->name() . ' expenses' ,
                    'description' => 'Overview of all the ' . $category_model->name() . ' expenses',
                    'image' => [
                        'icon' => 'dashboard.png',
                        'title' => 'Costs to Expect.com'
                    ]
                ],

                'api_requests' => Api::calledURIs(),

                'categories_summary' => $categories_summary,
                'subcategories_summary' =>$subcategories_summary,

                'child_details' => $child_model->details(),

                'active_category_id' => $category_model->id(),
                'active_category_name' => $category_model->name(),
                'active_category_uri_slug' => $category_model->uriSlug(),

                'recent_expenses' => $recent_expenses,
                'number_of_expenses' => $number_of_expenses,

                'total' => $total['total'],
                'total_number_of_expenses' => $total_number_of_expenses,

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

        $overview_model = new Overview();
        $expense_model = new Expense();
        $child_model = $this->childModel($child);
        $category_model = Category::modelById($category_uri);
        $subcategory_model = new Subcategory();

        $categories_summary_data = $overview_model->categoriesSummary($child_model->id());
        $categories_summary = $categories_summary_data['summary'];

        $total = $child_model->total();
        $total_number_of_expenses = $child_model->totalNumberOfExpenses();

        $subcategories_summary = $category_model->subcategorySummary($child_model->id(), $category_model->id());

        $subcategory = $subcategory_model->subcategory($category_model->id(), $subcategory_id);
        if ($subcategory === null) {
            redirect('/');
        }

        $largest_essential_expense = $overview_model->largestEssentialExpense($child_model->id());
        $largest_non_essential_expense = $overview_model->largestNonEssentialExpense($child_model->id());
        $largest_hobby_interest_expense = $overview_model->largestHobbyInterestExpense($child_model->id());

        $recent_expenses_data = $expense_model->recentExpensesBySubcategory(
            $child_model->id(),
            $category_model->id(),
            $subcategory_id
        );
        $recent_expenses = $recent_expenses_data['expenses'];
        $number_of_expenses = $recent_expenses_data['total'];

        return view(
            'child-subcategory',
            [
                'menus' => $this->menus(),
                'active' => $child_model->uri(),
                'meta' => [
                    'title' => $child_model->details()['name'],
                    'description' => 'What does it cost to raise a child to adulthood in the UK?'
                ],
                'welcome' => [
                    'title' => $child_model->details()['name'] . ': ' .
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

                'child_details' => $child_model->details(),

                'active_category_id' => $category_model->id(),
                'active_category_name' => $category_model->name(),
                'active_category_uri_slug' => $category_model->uriSlug(),

                'active_subcategory_id' => $subcategory_id,
                'active_subcategory_name' => $subcategory['name'],

                'recent_expenses' => $recent_expenses,
                'number_of_expenses' => $number_of_expenses,

                'total' => $total['total'],
                'total_number_of_expenses' => $total_number_of_expenses,

                'largest_essential_expense' => $largest_essential_expense,
                'largest_non_essential_expense' => $largest_non_essential_expense,
                'largest_hobby_interest_expense' => $largest_hobby_interest_expense
            ]
        );
    }

    /**
     * Year overview page for each child
     *
     * @param Request $request
     * @param string $child
     * @param string $year
     *
     * @return View
     */
    public function year(Request $request, string $child, string $year): View
    {
        Api::resetCalledURIs();

        $overview_model = new Overview();
        $expense_model = new Expense();
        $annual_model = new Annual();

        $child_model = $this->childModel($child);

        $total = $child_model->total();
        $total_number_of_expenses = $child_model->totalNumberOfExpenses();

        $annual_summary = $annual_model->annualSummary($child_model->id(), false);
        $monthly_summary = $annual_model->monthlySummary($child_model->id(), (int) $year);

        $largest_essential_expense = $overview_model->largestEssentialExpense($child_model->id());
        $largest_non_essential_expense = $overview_model->largestNonEssentialExpense($child_model->id());
        $largest_hobby_interest_expense = $overview_model->largestHobbyInterestExpense($child_model->id());

        $recent_expenses_data = $expense_model->recentExpensesByYear(
            $child_model->id(),
            (int) $year
        );
        $recent_expenses = $recent_expenses_data['expenses'];
        $number_of_expenses = $recent_expenses_data['total'];

        return view(
            'child-year',
            [
                'menus' => $this->menus(),
                'active' => $child_model->uri(),
                'meta' => [
                    'title' => $child_model->details()['name'],
                    'description' => 'What does it cost to raise a child to adulthood in the UK?'
                ],
                'welcome' => [
                    'title' => $child_model->details()['name'] . ': ' . $year . ' expenses' ,
                    'description' => 'Overview of all the ' . $year . ' expenses',
                    'image' => [
                        'icon' => 'dashboard.png',
                        'title' => 'Costs to Expect.com'
                    ]
                ],

                'api_requests' => Api::calledURIs(),

                'annual_summary' => $annual_summary,
                'monthly_summary' => $monthly_summary,

                'child_details' => $child_model->details(),

                'active_year' => $year,

                'recent_expenses' => $recent_expenses,
                'number_of_expenses' => $number_of_expenses,

                'total' => $total['total'],
                'total_number_of_expenses' => $total_number_of_expenses,

                'largest_essential_expense' => $largest_essential_expense,
                'largest_non_essential_expense' => $largest_non_essential_expense,
                'largest_hobby_interest_expense' => $largest_hobby_interest_expense
            ]
        );
    }

    /**
     * Month overview page for each child
     *
     * @param Request $request
     * @param string $child
     * @param string $year
     * @param string $month
     *
     * @return View
     */
    public function month(Request $request, string $child, string $year, string $month): View
    {
        Api::resetCalledURIs();

        $overview_model = new Overview();
        $expense_model = new Expense();
        $annual_model = new Annual();

        $child_model = $this->childModel($child);

        $total = $child_model->total();
        $total_number_of_expenses = $child_model->totalNumberOfExpenses();

        $annual_summary = $annual_model->annualSummary($child_model->id(), false);
        $monthly_summary = $annual_model->monthlySummary($child_model->id(), (int) $year);

        $largest_essential_expense = $overview_model->largestEssentialExpense($child_model->id());
        $largest_non_essential_expense = $overview_model->largestNonEssentialExpense($child_model->id());
        $largest_hobby_interest_expense = $overview_model->largestHobbyInterestExpense($child_model->id());

        $recent_expenses_data = $expense_model->recentExpensesByMonth(
            $child_model->id(),
            (int) $year,
            (int) $month
        );
        $recent_expenses = $recent_expenses_data['expenses'];
        $number_of_expenses = $recent_expenses_data['total'];

        $active_month_name = date('F', mktime(0, 0, 0, $month, 5));

        return view(
            'child-month',
            [
                'menus' => $this->menus(),
                'active' => $child_model->uri(),
                'meta' => [
                    'title' => $child_model->details()['name'],
                    'description' => 'What does it cost to raise a child to adulthood in the UK?'
                ],
                'welcome' => [
                    'title' => $child_model->details()['name'] . ': ' . $active_month_name . ' ' . $year . ' expenses' ,
                    'description' => 'Overview of all the ' . $active_month_name . ' ' . $year . ' expenses',
                    'image' => [
                        'icon' => 'dashboard.png',
                        'title' => 'Costs to Expect.com'
                    ]
                ],

                'api_requests' => Api::calledURIs(),

                'annual_summary' => $annual_summary,
                'monthly_summary' => $monthly_summary,

                'child_details' => $child_model->details(),

                'active_year' => $year,
                'active_month' => $month,
                'active_month_name' => $active_month_name,

                'recent_expenses' => $recent_expenses,
                'number_of_expenses' => $number_of_expenses,

                'total' => $total['total'],
                'total_number_of_expenses' => $total_number_of_expenses,

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
