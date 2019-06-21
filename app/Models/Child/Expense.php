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
    private $expenses = null;
    /**
     * @var array|null
     */
    private $expenses_response = null;
    /**
     * @var array|null
     */
    private $expenses_headers = null;
    /**
     * @var bool
     */
    private $expenses_populated = false;

    public function recentExpensesForBothChildren(): ?array
    {
        $expenses = Api::recentExpensesForBothChildren();
        Api::setCalledURI('The 25 most recent expenses', Api::lastUri());

        return $expenses;
    }

    public function recentExpenses(string $child_id): array
    {
        if ($this->recentExpensesPopulated() === false) {
            $this->setRecentExpensesApiResponse(Api::recentExpenses($child_id));
            $this->setRecentExpensesApiHeaderResponse(Api::previousRequestHeaders());
            Api::setCalledURI('The 25 most recent expenses', Api::lastUri());

            if ($this->expenses_response !== null) {
                $this->expenses = $this->expenses_response;
                $this->expenses_populated = true;
            } else {
                $this->expenses = [];
            }
        }

        return [
            'expenses' => $this->expenses,
            'total' => $this->recentExpensesHeader('X-Total-Count')
        ];
    }

    public function recentExpensesByCategory(string $child_id, string $category_id): array
    {
        if ($this->recentExpensesPopulated() === false) {
            $this->setRecentExpensesApiResponse(Api::recentExpensesByCategory($child_id, $category_id));
            $this->setRecentExpensesApiHeaderResponse(Api::previousRequestHeaders());
            Api::setCalledURI('The 25 most recent expenses', Api::lastUri());

            if ($this->expenses_response !== null) {
                $this->expenses = $this->expenses_response;
                $this->expenses_populated = true;
            } else {
                $this->expenses = [];
            }
        }

        return [
            'expenses' => $this->expenses,
            'total' => $this->recentExpensesHeader('X-Total-Count')
        ];
    }

    public function recentExpensesBySubcategory(
        string $child_id,
        string $category_id,
        string $subcategory_id
    ): array
    {
        if ($this->recentExpensesPopulated() === false) {
            $this->setRecentExpensesApiResponse(
                Api::recentExpensesBySubcategory(
                    $child_id,
                    $category_id,
                    $subcategory_id
                )
            );
            $this->setRecentExpensesApiHeaderResponse(Api::previousRequestHeaders());
            Api::setCalledURI('The 25 most recent expenses', Api::lastUri());

            if ($this->expenses_response !== null) {
                $this->expenses = $this->expenses_response;
                $this->expenses_populated = true;
            } else {
                $this->expenses = [];
            }
        }

        return [
            'expenses' => $this->expenses,
            'total' => $this->recentExpensesHeader('X-Total-Count')
        ];
    }

    /**
     * Check to see if we have previously called this method within the request
     * if we have, the data will already be populated and we can return the
     * requested data without an expensive API call.
     *
     * @return bool
     */
    protected function recentExpensesPopulated(): bool
    {
        return $this->expenses_populated;
    }

    protected function setRecentExpensesApiResponse(?array $response)
    {
        if ($response !== null) {
            $this->expenses_response = $response;
        }
    }

    protected function setRecentExpensesApiHeaderResponse(?array $headers)
    {
        if ($headers !== null) {
            $this->expenses_headers = $headers;
        }
    }

    protected function recentExpensesHeaders()
    {
        if ($this->expenses_headers !== null) {
            return $this->expenses_headers;
        } else {
            return [];
        }
    }

    /**
     * @param string $header
     * @return int|null
     */
    protected function recentExpensesHeader(string $header)
    {
        $return = null;

        if ($this->expenses_headers !== null) {
            switch($header) {
                case 'X-Total-Count':
                    if (array_key_exists('X-Total-Count', $this->expenses_headers) === true) {
                        $return = intval($this->expenses_headers['X-Total-Count'][0]);
                    }
                    break;
            }
        }

        return $return;
    }
}
