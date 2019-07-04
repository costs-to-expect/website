<?php
declare(strict_types=1);

namespace App\Models\Child;

use App\Request\Api;

/**
 * @package App\Models
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Overview
{
    private $summary = null;
    private $summary_populated = false;

    private $essential_id;
    private $non_essential_id;
    private $hobby_interest_id;

    private $largest_essential_expense = null;
    private $largest_essential_expense_populated = false;

    private $largest_non_essential_expense = null;
    private $largest_non_essential_expense_populated = false;

    private $largest_hobby_interest_expense = null;
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
                'uri-slug' => trans('web/categories.essential-uri-slug'),
                'total' => 0.00
            ],
            $this->non_essential_id => [
                'name' => trans('web/categories.non-essential-name'),
                'description' => trans('web/categories.non-essential-description'),
                'uri-slug' => trans('web/categories.non-essential-uri-slug'),
                'total' => 0.00
            ],
            $this->hobby_interest_id => [
                'name' => trans('web/categories.hobby-interest-name'),
                'description' => trans('web/categories.hobby-interest-description'),
                'uri-slug' => trans('web/categories.hobby-interest-uri-slug'),
                'total' => 0.00
            ]
        ];
        }
    }

    /**
     * Fetch the largest essential expense for the requested child.
     *
     * Subsequent calls of this method will not execute an expense API call if
     * called within the same request
     *
     * @param string $child_id
     *
     * @return array|null
     */
    public function largestEssentialExpense($child_id): ?array
    {
        if ($this->largest_essential_expense_populated === false) {
            $response = Api::largestExpenseInCategory(
                $child_id,
                $this->essentialId()
            );
            Api::setCalledURI('Top Essential expense', Api::lastUri());

            if ($response !== null && array_key_exists(0, $response) === true) {
                $this->largest_essential_expense = $response[0];
                $this->largest_essential_expense_populated = true;
            } else {
                $this->largest_essential_expense = null;
            }
        }

        return $this->largest_essential_expense;
    }

    /**
     * Fetch the largest non-essential expense for the requested child.
     *
     * Subsequent calls of this method will not execute an expense API call if
     * called within the same request
     *
     * @param string $child_id
     *
     * @return array|null
     */
    public function largestNonEssentialExpense($child_id): ?array
    {
        if ($this->largest_non_essential_expense_populated === false) {
            $response = Api::largestExpenseInCategory(
                $child_id,
                $this->nonEssentialId()
            );
            Api::setCalledURI('Top Non-Essential expense', Api::lastUri());

            if ($response !== null && array_key_exists(0, $response) === true) {
                $this->largest_non_essential_expense = $response[0];
                $this->largest_non_essential_expense_populated = true;
            } else {
                $this->largest_non_essential_expense = null;
            }
        }

        return $this->largest_non_essential_expense;
    }

    /**
     * Fetch the largest hobby and interests expense for the requested child.
     *
     * Subsequent calls of this method will not execute an expense API call if
     * called within the same request
     *
     * @param string $child_id
     *
     * @return array|null
     */
    public function largestHobbyInterestExpense($child_id): ?array
    {
        if ($this->largest_hobby_interest_expense_populated === false) {
            $response = Api::largestExpenseInCategory(
                $child_id,
                $this->hobbyInterestId()
            );
            Api::setCalledURI('Top Hobby and Interests expense', Api::lastUri());

            if ($response !== null && array_key_exists(0, $response) === true) {
                $this->largest_hobby_interest_expense = $response[0];
                $this->largest_hobby_interest_expense_populated = true;
            } else {
                $this->largest_hobby_interest_expense = null;
            }
        }

        return $this->largest_hobby_interest_expense;
    }

    /**
     * Fetch the categories expenses summary for the requested child.
     *
     * Subsequent calls of this method will not execute an expense API call if
     * called within the same request
     *
     * @param string $child_id
     *
     * @return array|null
     */
    public function categoriesSummary($child_id): array
    {
        $total = 0.00;

        if ($this->summary_populated === false) {
            $response = Api::summaryExpensesGroupByCategory($child_id);
            Api::setCalledURI('Expenses summary by category', Api::lastUri());
            if ($response !== null) {
                $this->setCategoriesSummaryData();

                foreach ($response as $category) {
                    $this->summary[$category['id']]['total'] = $category['total'];
                }

                $total = $this->summary['98WLap7Bx3']['total'] +
                    $this->summary['RjXM5VJDw6']['total'] +
                    $this->summary['Gwg7zgL316']['total'];

                $this->summary_populated = true;
            } else {
                $this->summary = [];
            }
        }

        return [
            'summary' => $this->summary,
            'total' => $total
        ];
    }

    public function months(): array
    {
        return [
            1 => [
                'id' => 1,
                'name' => 'January'
            ],
            2 => [
                'id' => 2,
                'name' => 'February'
            ],
            3 => [
                'id' => 3,
                'name' => 'March'
            ],
            4 => [
                'id' => 4,
                'name' => 'April'
            ],
            5 => [
                'id' => 5,
                'name' => 'May'
            ],
            6 => [
                'id' => 6,
                'name' => 'June'
            ],
            7 => [
                'id' => 7,
                'name' => 'July'
            ],
            8 => [
                'id' => 8,
                'name' => 'August'
            ],
            9 => [
                'id' => 9,
                'name' => 'September'
            ],
            10 => [
                'id' => 10,
                'name' => 'October'
            ],
            11 => [
                'id' => 11,
                'name' => 'November'
            ],
            12 => [
                'id' => 12,
                'name' => 'December'
            ]
        ];
    }
}
