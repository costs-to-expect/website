<?php
declare(strict_types=1);

namespace App\Models;

/**
 * @package App\Models
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Category
{
    private $summary = null;
    private $summary_populated = false;

    private function setCategoriesSummaryData()
    {
        if ($this->summary === null) {
            $this->summary = [
            '98WLap7Bx3' => [
                'name' => 'Essential',
                'description' => 'Expenses that we consider essential in the raising a child',
                'total' => 0.00
            ],
            'RjXM5VJDw6' => [
                'name' => 'Non-Essential',
                'description' => 'Optional expenses, expenses that we consider non-essential in raising a child',
                'total' => 0.00
            ],
            'Gwg7zgL316' => [
                'name' => 'Hobbies & Interests',
                'description' => 'Leisure activities',
                'total' => 0.00
            ]
        ];
        }
    }

    /**
     * Check to see if we have previous called the categoriesSummary method within
     * this request, if we have the data will already be populated and we can return
     * the data without an API call.
     *
     * @return bool
     */
    public function categoriesSummaryPopulated(): bool
    {
        return $this->summary_populated;
    }

    /**
     * Return the child category totals data array
     *
     * @param array|null $api_data API data we will use to populate the data array
     *
     * @return array
     */
    public function categoriesSummary(?array $api_data): array
    {
        $this->setCategoriesSummaryData();

        if ($this->summary_populated === false) {
            if ($api_data !== null) {
                $this->summary_populated = true;
                foreach ($api_data as $category) {
                    $this->summary[$category['id']]['total'] = $category['total'];
                }
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
}
