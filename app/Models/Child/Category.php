<?php
declare(strict_types=1);

namespace App\Models\Child;

/**
 * @package App\Models
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Category
{
    private $summary = null;
    private $summary_response = null;
    private $summary_populated = false;

    private $essential_id;
    private $non_essential_id;
    private $hobby_interest_id;

    private $largest_essential_expense = null;
    private $largest_non_essential_expense = null;
    private $largest_hobby_interest_expense = null;
    private $largest_essential_expense_response = null;
    private $largest_non_essential_expense_response = null;
    private $largest_hobby_interest_expense_response = null;
    private $largest_essential_expense_populated = false;
    private $largest_non_essential_expense_populated = false;
    private $largest_hobby_interest_expense_populated = false;

    public function __construct()
    {
        $this->essential_id = trans('web/categories.essential-id');
        $this->non_essential_id = trans('web/categories.non-essential-id');
        $this->hobby_interest_id = trans('web/categories.hobby-interest-id');
    }

    public function essentialId(): string
    {
        return $this->essential_id;
    }

    public function nonEssentialId(): string
    {
        return $this->non_essential_id;
    }

    public function hobbyInterestId(): string
    {
        return $this->hobby_interest_id;
    }

    private function setCategoriesSummaryData()
    {
        if ($this->summary === null) {
            $this->summary = [
            $this->essential_id => [
                'name' => trans('web/categories.essential-name'),
                'description' => trans('web/categories.essential-description'),
                'total' => 0.00
            ],
            $this->non_essential_id => [
                'name' => trans('web/categories.non-essential-name'),
                'description' => trans('web/categories.non-essential-description'),
                'total' => 0.00
            ],
            $this->hobby_interest_id => [
                'name' => trans('web/categories.hobby-interest-name'),
                'description' => trans('web/categories.hobby-interest-description'),
                'total' => 0.00
            ]
        ];
        }
    }

    /**
     * Check to see if we have previously called this method within the request
     * if we have, the data will already be populated and we can return the
     * requested data without an expensive API call.
     *
     * @return bool
     */
    public function categoriesSummaryPopulated(): bool
    {
        return $this->summary_populated;
    }

    public function setCategoriesSummaryApiResponse(?array $response)
    {
        if ($response !== null) {
            $this->summary_response = $response;
        }
    }

    /**
     * Return the child category totals data array
     *
     * @return array
     */
    public function categoriesSummary(): array
    {
        if ($this->summary_populated === false) {
            $this->setCategoriesSummaryData();

            if ($this->summary_response !== null) {
                foreach ($this->summary_response as $category) {
                    $this->summary[$category['id']]['total'] = $category['total'];
                }

                $this->summary_populated = true;
            }
        }

        return $this->summary;
    }

    /**
     * Return the total cost based on the category summary values
     *
     * @return float
     */
    public function totalFromCategorySummary(): float
    {
        $total = 0.00;

        if ($this->summary_populated === true) {
            $total = $this->summary['98WLap7Bx3']['total'] + $this->summary['RjXM5VJDw6']['total'] + $this->summary['Gwg7zgL316']['total'];
        }

        return $total;
    }

    /**
     * Check to see if we have previously called the related method within the
     * request if we have, the data will already be populated and we can return
     * the requested data without an expensive API call.
     *
     * @return bool
     */
    public function largestEssentialExpensePopulated(): bool
    {
        return $this->largest_essential_expense_populated;
    }

    /**
     * Check to see if we have previously called the related method within the
     * request if we have, the data will already be populated and we can return
     * the requested data without an expensive API call.
     *
     * @return bool
     */
    public function largestNonEssentialExpensePopulated(): bool
    {
        return $this->largest_non_essential_expense_populated;
    }

    /**
     * Check to see if we have previously called the related method within the
     * request if we have, the data will already be populated and we can return
     * the requested data without an expensive API call.
     *
     * @return bool
     */
    public function largestHobbyInterestExpensePopulated(): bool
    {
        return $this->largest_hobby_interest_expense_populated;
    }

    public function setLargestEssentialExpenseResponse(?array $response)
    {
        if ($response !== null) {
            $this->largest_essential_expense_response = $response;
        }
    }

    public function setLargestNonEssentialExpenseResponse(?array $response)
    {
        if ($response !== null) {
            $this->largest_non_essential_expense_response = $response;
        }
    }

    public function setLargestHobbyInterestExpenseResponse(?array $response)
    {
        if ($response !== null) {
            $this->largest_hobby_interest_expense_response = $response;
        }
    }

    public function largestEssentialExpense(): ?array
    {
        if ($this->largest_essential_expense_populated === false) {
            if ($this->largest_essential_expense_response !== null && array_key_exists(0, $this->largest_essential_expense_response) === true) {
                $this->largest_essential_expense = $this->largest_essential_expense_response[0];
                $this->largest_essential_expense_populated = true;
            } else {
                $this->largest_essential_expense = null;
            }
        }

        return $this->largest_essential_expense;
    }

    public function largestNonEssentialExpense(): ?array
    {
        if ($this->largest_non_essential_expense_populated === false) {
            if ($this->largest_non_essential_expense_response !== null && array_key_exists(0, $this->largest_non_essential_expense_response) === true) {
                $this->largest_non_essential_expense = $this->largest_non_essential_expense_response[0];
                $this->largest_non_essential_expense_populated = true;
            } else {
                $this->largest_non_essential_expense = null;
            }
        }

        return $this->largest_non_essential_expense;
    }

    public function largestHobbyInterestExpense(): ?array
    {
        if ($this->largest_hobby_interest_expense_populated === false) {
            if ($this->largest_hobby_interest_expense_response !== null && array_key_exists(0, $this->largest_hobby_interest_expense_response) === true) {
                $this->largest_hobby_interest_expense = $this->largest_hobby_interest_expense_response[0];
                $this->largest_hobby_interest_expense_populated = true;
            } else {
                $this->largest_hobby_interest_expense = null;
            }
        }

        return $this->largest_hobby_interest_expense;
    }
}
