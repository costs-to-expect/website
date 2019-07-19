<?php
declare(strict_types=1);

namespace App\Models\Child;

use App\Request\Api;

/**
 * @package App\Models
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Expense
{
    /**
     * @var array|null
     */
    private $recent_expenses = [];
    /**
     * @var array|null
     */
    private $recent_expenses_headers = [];
    /**
     * @var bool
     */
    private $recent_expenses_populated = false;

    /**
     * @var array|null
     */
    private $expenses = [];
    /**
     * @var array|null
     */
    private $expenses_headers = [];
    /**
     * @var bool
     */
    private $expenses_populated = false;

    /**
     * @var array|null
     */
    private $expenses_summary = [];
    /**
     * @var bool
     */
    private $expenses_summary_populated = false;

    /**
     * Fetch all expenses for a data table
     *
     * @param string $child_id
     * @param integer $offset
     * @param integer $limit
     * @param string|null $category
     * @param string|null $subcategory
     * @param integer|null $year
     * @param integer|null $month
     * @param string|null $term
     *
     * @return array|null Returned array has four indexes, expenses, total, limit and offset
     */
    public function expenses(
        string $child_id,
        int $offset,
        int $limit,
        string $category = null,
        string $subcategory = null,
        int $year = null,
        int $month = null,
        string $term = null
    ): ?array
    {
        if ($this->expenses_populated === false) {
            $response = Api::expenses(
                $child_id,
                $offset,
                $limit,
                $category,
                $subcategory,
                $year,
                $month,
                $term
            );
            $headers = Api::previousRequestHeaders();
            Api::setCalledURI('All expenses', Api::lastUri());

            if ($response !== null) {
                $this->expenses = $response;
                $this->expenses_headers = $headers;
                $this->expenses_populated = true;
            }
        }

        $total = $this->header($this->expenses_headers, 'X-Total-Count');
        $offset = $this->header($this->expenses_headers, 'X-Offset');
        $limit = $this->header($this->expenses_headers, 'X-Limit');

        if ($total === null) {
            $total = 0;
        }

        if ($offset === null) {
            $offset = 0;
        }

        if ($limit === null) {
            $limit = 0;
        }

        return [
            'expenses' => $this->expenses,
            'total' => $total,
            'limit' => $limit,
            'offset' => $offset
        ];
    }

    /**
     * Fetch the summary of filtered expenses
     *
     * @param string $child_id
     * @param string|null $category
     * @param string|null $subcategory
     * @param integer|null $year
     * @param integer|null $month
     * @param string|null $term
     *
     * @return array|null
     */
    public function expensesSummary(
        string $child_id,
        string $category = null,
        string $subcategory = null,
        int $year = null,
        int $month = null,
        string $term = null
    ): ?array
    {
        if ($this->expenses_summary_populated === false) {
            $response = Api::expensesSummary(
                $child_id,
                $category,
                $subcategory,
                $year,
                $month,
                $term
            );
            Api::setCalledURI('Filtered expenses summary', Api::lastUri());

            if ($response !== null) {
                $this->expenses_summary = $response;
                $this->expenses_summary_populated = true;
            }
        }

        return $this->expenses_summary;
    }

    /**
     * Fetch the recent expenses for both children
     *
     * @return array|null
     */
    public function recentExpensesForBothChildren(): ?array
    {
        $expenses = Api::recentExpensesForBothChildren();
        Api::setCalledURI('25 most recent expenses', Api::lastUri());

        return $expenses;
    }

    /**
     * Fetch the recent expenses for the requested child
     *
     * Subsequent calls of this method will not execute an expense API call if
     * called within the same request
     *
     * @param string $child_id
     *
     * @return array|null
     */
    public function recentExpenses(string $child_id): array
    {
        if ($this->recent_expenses_populated === false) {
            $response = Api::recentExpenses($child_id);
            $headers = Api::previousRequestHeaders();
            Api::setCalledURI('25 most recent expenses', Api::lastUri());

            if ($response !== null) {
                $this->recent_expenses = $response;
                $this->recent_expenses_headers = $headers;
                $this->recent_expenses_populated = true;
            }
        }

        $total = $this->header($this->recent_expenses_headers, 'X-Total-Count');
        if ($total === null) {
            $total = 0;
        }

        return [
            'expenses' => $this->recent_expenses,
            'total' => $total
        ];
    }

    /**
     * Fetch the recent expenses for the requested child in the requested category
     *
     * Subsequent calls of this method will not execute an expense API call if
     * called within the same request
     *
     * @param string $child_id
     * @param string $category_id
     *
     * @return array|null
     */
    public function recentExpensesByCategory(string $child_id, string $category_id): array
    {
        if ($this->recent_expenses_populated === false) {
            $response = Api::recentExpensesByCategory($child_id, $category_id);
            $headers = Api::previousRequestHeaders();
            Api::setCalledURI('25 most recent expenses for category', Api::lastUri());

            if ($response !== null) {
                $this->recent_expenses = $response;
                $this->recent_expenses_headers = $headers;
                $this->recent_expenses_populated = true;
            }
        }

        $total = $this->header($this->recent_expenses_headers, 'X-Total-Count');
        if ($total === null) {
            $total = 0;
        }

        return [
            'expenses' => $this->recent_expenses,
            'total' => $total
        ];
    }

    /**
     * Fetch the recent expenses for the requested child in the requested year
     *
     * Subsequent calls of this method will not execute an expense API call if
     * called within the same request
     *
     * @param string $child_id
     * @param integer $year
     *
     * @return array|null
     */
    public function recentExpensesByYear(string $child_id, int $year): array
    {
        if ($this->recent_expenses_populated === false) {
            $response = Api::recentExpensesByYear($child_id, $year);
            $headers = Api::previousRequestHeaders();
            Api::setCalledURI('25 most recent expenses for ' . $year, Api::lastUri());

            if ($response !== null) {
                $this->recent_expenses = $response;
                $this->recent_expenses_headers = $headers;
                $this->recent_expenses_populated = true;
            }
        }

        $total = $this->header($this->recent_expenses_headers, 'X-Total-Count');
        if ($total === null) {
            $total = 0;
        }

        return [
            'expenses' => $this->recent_expenses,
            'total' => $total
        ];
    }

    /**
     * Fetch the recent expenses for the requested child in the requested month
     *
     * Subsequent calls of this method will not execute an expense API call if
     * called within the same request
     *
     * @param string $child_id
     * @param integer $year
     * @param integer $month
     *
     * @return array|null
     */
    public function recentExpensesByMonth(string $child_id, int $year, int $month): array
    {
        if ($this->recent_expenses_populated === false) {
            $response = Api::recentExpensesByMonth($child_id, $year, $month);
            $headers = Api::previousRequestHeaders();
            Api::setCalledURI('25 most recent expenses for ' . date('F', mktime(0, 0, 0, $month, 5)) . ' ' . $year, Api::lastUri());

            if ($response !== null) {
                $this->recent_expenses = $response;
                $this->recent_expenses_headers = $headers;
                $this->recent_expenses_populated = true;
            }
        }

        $total = $this->header($this->recent_expenses_headers, 'X-Total-Count');
        if ($total === null) {
            $total = 0;
        }

        return [
            'expenses' => $this->recent_expenses,
            'total' => $total
        ];
    }

    /**
     * Fetch the recent expenses for the requested child in the requested
     * subcategory
     *
     * Subsequent calls of this method will not execute an expense API call if
     * called within the same request
     *
     * @param string $child_id
     * @param string $category_id
     * @param string $subcategory_id
     *
     * @return array|null
     */
    public function recentExpensesBySubcategory(
        string $child_id,
        string $category_id,
        string $subcategory_id
    ): array
    {
        if ($this->recent_expenses_populated === false) {
            $response = Api::recentExpensesBySubcategory($child_id, $category_id, $subcategory_id);
            $headers = Api::previousRequestHeaders();
            Api::setCalledURI('25 most recent expenses for subcategory', Api::lastUri());

            if ($response !== null) {
                $this->recent_expenses = $response;
                $this->recent_expenses_headers = $headers;
                $this->recent_expenses_populated = true;
            }
        }

        $total = $this->header($this->recent_expenses_headers, 'X-Total-Count');
        if ($total === null) {
            $total = 0;
        }

        return [
            'expenses' => $this->recent_expenses,
            'total' => $total
        ];
    }

    /**
     * @param array $headers
     * @param string key
     *
     * @return int|null
     */
    protected function header(array $headers, string $key)
    {
        $return = null;

        if ($headers !== null) {
            switch($key) {
                case 'X-Total-Count':
                case 'X-Limit':
                case 'X-Offset':
                    if (array_key_exists($key, $headers) === true) {
                        $return = intval($headers[$key][0]);
                    }
                    break;
                default:
                    $return = 'NOT-SET';
                    break;

            }
        }

        return $return;
    }
}
