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

        $child_overview = $this->childOverview($child_model, $overview_model);

        $categories_summary_data = $overview_model->categoriesSummary($child_model->id());
        $categories_summary = $categories_summary_data['summary'];

        $annual_summary = $annual_model->annualSummary($child_model->id());

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

                'child_overview' => $child_overview,
                'child_details' => $child_model->details(),

                'recent_expenses' => $recent_expenses,
                'number_of_expenses' => $number_of_expenses,
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
        if (array_key_exists('term', $params) === true && strlen($params['term']) > 0) {
            $filter_params['term'] = urlencode($params['term']);
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

        $offset = (int) request()->query('offset', 0);
        $limit = (int) request()->query('limit', 50);
        $category_id = request()->query('category');
        $subcategory_id = request()->query('subcategory');
        $year = request()->query('year');
        $month = request()->query('month');
        $term = request()->query('term');

        $filtered = false;

        $child_overview = $this->childOverview($child_model, $overview_model);

        $subcategories = [];
        if ($category_id !== null) {
            $selected_category_model = Category::modelById($category_id);
            $subcategories = $selected_category_model->subcategories($category_id);
        }

        $years = $child_model->years();
        $months = $overview_model->months();

        $filter_parameters = [
            'category' => $category_id,
            'subcategory' => $subcategory_id,
            'year' => $year,
            'month' => $month,
            'term' => $term
        ];

        if ($category_id !== null) {
            $filter_parameters['category'] = $category_id;
            $filtered = true;

            if ($subcategory_id !== null) {
                $filter_parameters['subcategory'] = $subcategory_id;
            }
        }
        if ($year !== null && (int) $year !== 0) {
            $filtered = true;
            $filter_parameters['year'] = (int) $year;
        }
        if ($month !== null && (int) $month !== 0) {
            $filtered = true;
            $filter_parameters['month'] = (int) $month;
        }
        if ($term !== null) {
            $filtered = false; // Not supported for now
            $filter_parameters['term'] = $term;
        }

        $base_uri = $uri = $child_model->uri() . '/expenses?limit=' . $limit . '&offset=' . $offset;
        $named_anchor = '#expenses-table';

        $assigned_filter_uris = $this->assignedFilterUris(
            $base_uri,
            $named_anchor,
            $filter_parameters['category'],
            $filter_parameters['subcategory'],
            $filter_parameters['year'],
            $filter_parameters['month'],
            $filter_parameters['term']
        );

        $expenses_data = $expense_model->expenses(
            $child_model->id(),
            $offset,
            $limit,
            $filter_parameters['category'],
            $filter_parameters['subcategory'],
            $filter_parameters['year'],
            $filter_parameters['month'],
            $filter_parameters['term']
        );

        $filtered_summary = null;
        if ($filtered === true) {
            $filtered_summary = $expense_model->expensesSummary(
                $child_model->id(),
                $filter_parameters['category'],
                $filter_parameters['subcategory'],
                $filter_parameters['year'],
                $filter_parameters['month'],
                $filter_parameters['term']
            );

            if ($filtered_summary !== null) {
                $filtered_summary = $filtered_summary['total'];
            }
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

                'child_overview' => $child_overview,
                'child_details' => $child_model->details(),

                'expenses' => $expenses_data['expenses'],

                'filtered' => $filtered,
                'filtered_summary' => $filtered_summary,

                'filters' => [
                    'category' => [
                        'name' => 'Category',
                        'title' => 'Filter by category',
                        'values' => $category_model->allCategories(),
                        'set' => $filter_parameters['category'],
                        'uri' => $assigned_filter_uris['category'],
                        'classes' => 'col-6 col-md-4 col-lg-4 col-xl-2 mb-2'
                    ],
                    'subcategory' => [
                        'name' => 'Subcategory',
                        'title' => 'Filter by subcategory',
                        'values' => $subcategories,
                        'set' => $filter_parameters['subcategory'],
                        'uri' => $assigned_filter_uris['subcategory'],
                        'classes' => 'col-6 col-md-3 col-lg-4 col-xl-3 mb-2'
                    ],
                    'year' => [
                        'name' => 'Year',
                        'title' => 'Filter by year',
                        'values' => $years,
                        'set' => $filter_parameters['year'],
                        'uri' => $assigned_filter_uris['year'],
                        'classes' => 'col-6 col-md-2 col-lg-2 col-xl-2 mb-2'
                    ],
                    'month' => [
                        'name' => 'Month',
                        'title' => 'Filter by month',
                        'values' => $months,
                        'set' => $filter_parameters['month'],
                        'uri' => $assigned_filter_uris['month'],
                        'classes' => 'col-6 col-md-3 col-lg-2 col-xl-2 mb-2'
                    ],
                    'term' => [
                        'name' => 'Search',
                        'values' => [],
                        'set' => $term,
                        'uri' => $assigned_filter_uris['term'],
                        'classes' => null
                    ]
                ],

                'pagination' => [
                    'uri' => [
                        'base' => $child_model->uri() . '/expenses',
                        'parameters' => $filter_parameters,
                        'anchor' => '#expenses-table'
                    ],
                    'total' => $expenses_data['total'],
                    'offset' => $expenses_data['offset'],
                    'limit' => $expenses_data['limit']
                ]
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

        $child_overview = $this->childOverview($child_model, $overview_model);

        $categories_summary_data = $overview_model->categoriesSummary($child_model->id());
        $categories_summary = $categories_summary_data['summary'];

        $subcategories_summary = $category_model->subcategorySummary($child_model->id(), $category_model->id());

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

                'child_overview' => $child_overview,
                'child_details' => $child_model->details(),

                'active_category_id' => $category_model->id(),
                'active_category_name' => $category_model->name(),
                'active_category_uri_slug' => $category_model->uriSlug(),

                'recent_expenses' => $recent_expenses,
                'number_of_expenses' => $number_of_expenses,
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

        $child_overview = $this->childOverview($child_model, $overview_model);

        $categories_summary_data = $overview_model->categoriesSummary($child_model->id());
        $categories_summary = $categories_summary_data['summary'];

        $subcategories_summary = $category_model->subcategorySummary($child_model->id(), $category_model->id());

        $subcategory = $subcategory_model->subcategory($category_model->id(), $subcategory_id);
        if ($subcategory === null) {
            redirect('/');
        }

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

                'child_overview' => $child_overview,
                'child_details' => $child_model->details(),

                'active_category_id' => $category_model->id(),
                'active_category_name' => $category_model->name(),
                'active_category_uri_slug' => $category_model->uriSlug(),

                'active_subcategory_id' => $subcategory_id,
                'active_subcategory_name' => $subcategory['name'],

                'recent_expenses' => $recent_expenses,
                'number_of_expenses' => $number_of_expenses,
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

        $child_overview = $this->childOverview($child_model, $overview_model);

        $annual_summary = $annual_model->annualSummary($child_model->id(), false);
        $monthly_summary = $annual_model->monthlySummary($child_model->id(), (int) $year);

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

                'child_overview' => $child_overview,
                'child_details' => $child_model->details(),

                'active_year' => $year,

                'recent_expenses' => $recent_expenses,
                'number_of_expenses' => $number_of_expenses
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

        $child_overview = $this->childOverview($child_model, $overview_model);

        $annual_summary = $annual_model->annualSummary($child_model->id(), false);
        $monthly_summary = $annual_model->monthlySummary($child_model->id(), (int) $year);

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

                'child_overview' => $child_overview,
                'child_details' => $child_model->details(),

                'active_year' => $year,
                'active_month' => $month,
                'active_month_name' => $active_month_name,

                'recent_expenses' => $recent_expenses,
                'number_of_expenses' => $number_of_expenses
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
     * @param Child $child_model
     * @param Overview $overview_model
     *
     * @return array
     */
    private function childOverview(Child $child_model, Overview $overview_model)
    {
        return [
            'child_details' => $child_model->details(),
            'total' => $child_model->total()['total'],
            'total_number_of_expenses' => $child_model->totalNumberOfExpenses(),
            'largest_essential_expense' => $overview_model->largestEssentialExpense($child_model->id()),
            'largest_non_essential_expense' => $overview_model->largestNonEssentialExpense($child_model->id()),
            'largest_hobby_interest_expense' => $overview_model->largestHobbyInterestExpense($child_model->id())
        ];
    }

    /**
     * Generate the uris for any assigned filters, remove the assigned filter
     * leaving the applicable filters after removal
     *
     * @param string $base_uri
     * @param string $named_anchor
     * @param string $category_id
     * @param string $subcategory_id
     * @param integer $year
     * @param integer $month
     * @param string $term
     *
     * @return array
     */
    private function assignedFilterUris(
        string $base_uri,
        string $named_anchor,
        string $category_id = null,
        string $subcategory_id = null,
        int $year = null,
        int $month = null,
        string $term = null
    ): array
    {
        $uris = [
            'category' => $base_uri . $named_anchor,
            'subcategory' => $base_uri . $named_anchor,
            'year' => $base_uri . $named_anchor,
            'month' => $base_uri . $named_anchor,
            'term' => $base_uri . $named_anchor,
        ];

        if ($category_id !== null) {
            $params = $this->assignedFilterUriParamsCategory(
                $year,
                $month,
                $term
            );

            if (count($params) !== 0) {
                $uris['category'] = $this->generateAssignedFilterUri(
                    $base_uri,
                    $named_anchor,
                    $params
                );
            }
        }

        if ($subcategory_id !== null) {
            $params = $this->assignedFilterUriParamsSubcategory(
                $category_id,
                $year,
                $month,
                $term
            );

            if (count($params) !== 0) {
                $uris['subcategory'] = $this->generateAssignedFilterUri(
                    $base_uri,
                    $named_anchor,
                    $params
                );
            }
        }

        if ($year !== null && $year !== 0) {
            $params = $this->assignedFilterUriParamsYear(
                $category_id,
                $subcategory_id,
                $term
            );

            if (count($params) !== 0) {
                $uris['year'] = $this->generateAssignedFilterUri(
                    $base_uri,
                    $named_anchor,
                    $params
                );
            }
        }

        if ($month !== null) {
            $params = $this->assignedFilterUriParamsMonth(
                $category_id,
                $subcategory_id,
                $year,
                $term
            );

            if (count($params) !== 0) {
                $uris['month'] = $this->generateAssignedFilterUri(
                    $base_uri,
                    $named_anchor,
                    $params
                );
            }
        }

        if ($term !== null) {
            $params = $this->assignedFilterUriParamsTerm(
                $category_id,
                $subcategory_id,
                $year,
                $month
            );

            if (count($params) !== 0) {
                $uris['term'] = $this->generateAssignedFilterUri(
                    $base_uri,
                    $named_anchor,
                    $params
                );
            }
        }

        return $uris;
    }


    /**
     * @param string|null $category_id
     * @param string|null $subcategory_id
     * @param string|null $term
     *
     * @return array
     */
    private function assignedFilterUriParamsYear(
        string $category_id = null,
        string $subcategory_id = null,
        string $term = null
    ): array
    {
        $params = [];
        if ($category_id !== null) {
            $params['category'] = $category_id;
        }
        if ($subcategory_id !== null) {
            $params['subcategory'] = $subcategory_id;
        }
        if ($term !== null) {
            $params['term'] = urlencode($term);
        }

        return $params;
    }

    /**
     * @param string|null $category_id
     * @param string|null $subcategory_id
     * @param integer|null $year
     * @param string|null $term
     *
     * @return array
     */
    private function assignedFilterUriParamsMonth(
        string $category_id = null,
        string $subcategory_id = null,
        int $year = null,
        string $term = null
    ): array
    {
        $params = [];
        if ($category_id !== null) {
            $params['category'] = $category_id;
        }
        if ($subcategory_id !== null) {
            $params['subcategory'] = $subcategory_id;
        }
        if ($year !== null && $year !== 0) {
            $params['year'] = $year;
        }
        if ($term !== null) {
            $params['term'] = urlencode($term);
        }

        return $params;
    }

    /**
     * @param integer|null $year
     * @param integer|null $month
     * @param string|null $term
     *
     * @return array
     */
    private function assignedFilterUriParamsCategory(
        int $year = null,
        int $month = null,
        string $term = null
    ): array
    {
        $params = [];
        if ($year !== null && $year !== 0) {
            $params['year'] = $year;
        }
        if ($month !== null && $month !== 0) {
            $params['month'] = $month;
        }
        if ($term !== null) {
            $params['term'] = urlencode($term);
        }

        return $params;
    }

    /**
     * @param string|null $category_id
     * @param integer|null $year
     * @param integer|null $month
     * @param string|null $term
     *
     * @return array
     */
    private function assignedFilterUriParamsSubcategory(
        string $category_id = null,
        int $year = null,
        int $month = null,
        string $term = null
    ): array
    {
        $params = [];
        if ($category_id !== null) {
            $params['category'] = $category_id;
        }
        if ($year !== null && $year !== 0) {
            $params['year'] = $year;
        }
        if ($month !== null && $month !== 0) {
            $params['month'] = $month;
        }
        if ($term !== null) {
            $params['term'] = urlencode($term);
        }

        return $params;
    }

    /**
     * @param string|null $category_id
     * @param string|null $subcategory_id
     * @param integer|null $year
     * @param integer|null $month
     *
     * @return array
     */
    private function assignedFilterUriParamsTerm(
        string $category_id = null,
        string $subcategory_id = null,
        int $year = null,
        int $month = null
    ): array
    {
        $params = [];
        if ($category_id !== null) {
            $params['category'] = $category_id;
        }
        if ($subcategory_id !== null) {
            $params['subcategory'] = $subcategory_id;
        }
        if ($year !== null && $year !== 0) {
            $params['year'] = $year;
        }
        if ($month !== null && $month !== 0) {
            $params['month'] = $month;
        }

        return $params;
    }

    private function generateAssignedFilterUri(
        string $base_uri,
        string $named_anchor,
        array $params
    ): string
    {
        $uri = $base_uri;
        foreach ($params as $param => $value) {
            $uri .= '&' . $param . '=' . $value;
        }
        return $uri . $named_anchor;
    }
}
