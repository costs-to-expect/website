<?php
declare(strict_types=1);

namespace App\Models\Child;

/**
 * @package App\Models
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Annual
{
    private $summary = null;
    private $summary_populated = false;

    private function setAnnualSummaryData()
    {
        if ($this->summary === null) {
            for ($i = intval(date('Y')) - 2; $i <= intval(date('Y')); $i++) {
                $this->summary[$i] = [
                    'year' => $i,
                    'total' => 0.00
                ];
            }
        }
    }

    /**
     * Check to see if we have previously called the annualSummary method within
     * this request, if we have the data will already be populated and we can
     * return the data without having to make an expensive an API call.
     *
     * @return bool
     */
    public function annualSummaryPopulated(): bool
    {
        return $this->summary_populated;
    }

    /**
     * Return the annual summary data array
     *
     * @param array|null $api_data API data we will use to populate the data
     * array
     *
     * @return array
     */
    public function annualSummary(?array $api_data): array
    {
        $this->setAnnualSummaryData();

        if ($this->summary_populated === false) {
            if ($api_data !== null) {
                $this->summary_populated = true;

                foreach ($api_data as $year) {
                    if (array_key_exists($year['year'], $this->summary) === true) {
                        $this->summary[$year['year']]['total'] = $year['total'];
                    }
                }
            }
        }

        return $this->summary;
    }
}
