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
     * Fetch the recent expenses for both children
     *
     * @return array|null
     */
    public function recentExpensesForBothChildren(): ?array
    {
        $expenses = Api::recentExpensesForBothChildren();
        Api::setCalledURI('The 25 most recent expenses', Api::lastUri());

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
        if ($this->expenses_populated === false) {
            $response = Api::recentExpenses($child_id);
            $headers = Api::previousRequestHeaders();
            Api::setCalledURI('The 25 most recent expenses', Api::lastUri());

            if ($response !== null) {
                $this->expenses = $response;
                $this->expenses_headers = $headers;
                $this->expenses_populated = true;
            }
        }

        $total = $this->header($this->expenses_headers, 'X-Total-Count');
        if ($total === null) {
            $total = 0;
        }

        return [
            'expenses' => $this->expenses,
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
        if ($this->expenses_populated === false) {
            $response = Api::recentExpensesByCategory($child_id, $category_id);
            $headers = Api::previousRequestHeaders();
            Api::setCalledURI('The 25 most recent expenses for category', Api::lastUri());

            if ($response !== null) {
                $this->expenses = $response;
                $this->expenses_headers = $headers;
                $this->expenses_populated = true;
            }
        }

        $total = $this->header($this->expenses_headers, 'X-Total-Count');
        if ($total === null) {
            $total = 0;
        }

        return [
            'expenses' => $this->expenses,
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
        if ($this->expenses_populated === false) {
            $response = Api::recentExpensesBySubcategory($child_id, $category_id, $subcategory_id);
            $headers = Api::previousRequestHeaders();
            Api::setCalledURI('The 25 most recent expenses for subcategory', Api::lastUri());

            if ($response !== null) {
                $this->expenses = $response;
                $this->expenses_headers = $headers;
                $this->expenses_populated = true;
            }
        }

        $total = $this->header($this->expenses_headers, 'X-Total-Count');
        if ($total === null) {
            $total = 0;
        }

        return [
            'expenses' => $this->expenses,
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
                    if (array_key_exists('X-Total-Count', $headers) === true) {
                        $return = intval($headers['X-Total-Count'][0]);
                    }
                    break;
            }
        }

        return $return;
    }
}
