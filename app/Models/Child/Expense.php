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

    /**
     * Check to see if we have previously called this method within the request
     * if we have, the data will already be populated and we can return the
     * requested data without an expensive API call.
     *
     * @return bool
     */
    public function recentExpensesPopulated(): bool
    {
        return $this->expenses_populated;
    }

    public function setRecentExpensesApiResponse(?array $response)
    {
        if ($response !== null) {
            $this->expenses_response = $response;
        }
    }

    public function setRecentExpensesApiHeaderResponse(?array $headers)
    {
        if ($headers !== null) {
            $this->expenses_headers = $headers;
        }
    }

    public function recentExpenses(): array
    {
        if ($this->expenses_populated === false) {
            if ($this->expenses_response !== null) {
                $this->expenses = $this->expenses_response;
                $this->expenses_populated = true;
            } else {
                $this->expenses = [];
            }
        }

        return $this->expenses;
    }

    public function recentExpensesHeaders()
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
    public function recentExpensesHeader(string $header)
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
