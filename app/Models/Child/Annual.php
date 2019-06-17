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
    private $summary_response = null;
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
     * Check to see if we have previously called this method within the request
     * if we have, the data will already be populated and we can return the
     * requested data without an expensive API call.
     *
     * @return bool
     */
    public function annualSummaryPopulated(): bool
    {
        return $this->summary_populated;
    }

    public function setAnnualSummaryApiResponse(?array $response)
    {
        if ($response !== null) {
            $this->summary_response = $response;
        }
    }

    /**
     * Return the annual summary data array
     *
     * @return array
     */
    public function annualSummary(): array
    {
        if ($this->summary_populated === false) {
            $this->setAnnualSummaryData();

            if ($this->summary_response !== null) {
                foreach ($this->summary_response as $year) {
                    if (array_key_exists($year['year'], $this->summary) === true) {
                        $this->summary[$year['year']]['total'] = $year['total'];
                    }
                }

                $this->summary_populated = true;
            }
        }

        return $this->summary;
    }
}
