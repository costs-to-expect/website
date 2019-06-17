<?php
declare(strict_types=1);

namespace App\Models\Child;

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
     * @var bool
     */
    private $expenses_populated = false;

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

    public function setAnnualSummaryApiResponse(?array $response)
    {
        if ($response !== null) {
            $this->expenses_response = $response;
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


}
