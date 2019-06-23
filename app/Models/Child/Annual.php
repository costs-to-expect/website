<?php
declare(strict_types=1);

namespace App\Models\Child;

use App\Request\Api;

/**
 * @package App\Models
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Annual
{
    private $summary = null;
    private $summary_populated = false;

     /**
     * Fetch the annual expenses summary for a child
     *
     * Subsequent calls of this method will not execute an expense API call if
     * called within the same request
     *
     * @param string $child_id
     * @param boolean $partial Return a partial summary, just the last three years
     *
     * @return array|null
     */
    public function annualSummary(string $child_id, bool $partial = true): array
    {
        if ($this->summary_populated === false) {

            $response = Api::summaryExpensesAnnual($child_id);
            Api::setCalledURI('Expenses summary by year', Api::lastUri());

            if ($partial === true) {
                for ($i = intval(date('Y')) - 2; $i <= intval(date('Y')); $i++) {
                    $this->summary[$i] = [
                        'year' => $i,
                        'total' => 0.00
                    ];
                }

                if ($response !== null) {
                    foreach ($response as $year) {
                        if (array_key_exists($year['year'], $this->summary) === true) {
                            $this->summary[$year['year']]['total'] = (float) $year['total'];
                        }
                    }
                }
            } else {
                if ($response !== null) {
                    foreach ($response as $year) {
                        $this->summary[$year['year']] = [
                            'year' => $year['year'],
                            'total' => (float) $year['total']
                        ];
                    }
                } else {
                    $this->summary = [];
                }
            }
        }

        return $this->summary;
    }
}
