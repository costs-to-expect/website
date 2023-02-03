<?php
declare(strict_types=1);

namespace App\Models;

use App\Request\Api;

/**
 * @package App\Models
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
abstract class Child
{
    protected $id;

    protected $uri;

    protected $version;
    protected $name;
    protected $dob;
    protected $sex;
    protected $weight;
    protected $short_name;
    protected $image_uri;
    protected $first_year;

    protected $total = null;
    protected $total_populated = false;

    protected $total_current_year = null;
    protected $total_current_year_populated = false;

    protected $expenses_headers_populated = false;
    protected $expenses_headers = null;

    public function details(): array
    {
        return [
            'version' => $this->version,
            'name' => $this->name,
            'dob' => $this->dob,
            'sex' => $this->sex,
            'weight' => $this->weight,
            'short_name' => $this->short_name,
            'image_uri' => $this->image_uri,
            'uri' => $this->uri,
        ];
    }

    public function id(): string
    {
        return $this->id;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function total(): array
    {
        if ($this->total_populated === false) {
            $response = Api::summaryExpenses($this->id);
            Api::setCalledURI('Total expenses for ' . $this->short_name, Api::lastUri());

            $this->total = [
                'name' => $this->name,
                'dob' => $this->dob,
                'total' => 0.00
            ];

            if ($response !== null) {
                foreach ($response as $subtotal) {
                    if ($subtotal['currency']['code'] === 'GBP') {
                        $this->total['total'] = $subtotal['subtotal'];
                        $this->total_populated = true;
                        break;
                    }
                }
            }
        }

        return $this->total;
    }

    public function totalNumberOfExpenses(): int
    {
        if ($this->expenses_headers_populated === false) {
            $this->expensesHeaders();
        }

        if (array_key_exists('X-Total-Count', $this->expenses_headers) === true) {
            return (int) $this->expenses_headers['X-Total-Count'][0];
        }

        return 0;
    }

    protected function expensesHeaders(): array
    {
        if ($this->expenses_headers_populated === false) {
            $response = Api::expensesHead($this->id);
            Api::setCalledURI('All expenses for ' . $this->short_name, Api::lastUri(), 'HEAD');

            $this->expenses_headers = [];

            if ($response !== null) {
                $this->expenses_headers = $response;
                $this->expenses_headers_populated = true;
            }
        }

        return $this->expenses_headers;
    }

    /**
     * Fetch the subcategory summary for the requested child and category for the requested subcategory
     *
     * Subsequent calls of this method will not execute an expense API call if
     * called within the same request
     *
     * @return float
     */
    public function totalCurrentYear(): float
    {
        if ($this->total_current_year_populated === false) {
            $response = Api::summaryExpensesForCurrentYear($this->id);
            Api::setCalledURI('Current year expenses for ' . $this->short_name, Api::lastUri());

            $this->total_current_year = 0.00;

            if ($response !== null && array_key_exists('subtotals', $response) === true) {
                foreach ($response['subtotals'] as $subtotal) {
                    if ($subtotal['currency']['code'] === 'GBP') {
                        $this->total_current_year = (float) $subtotal['subtotal'];
                        $this->total_current_year_populated = true;
                        break;
                    }
                }
            }
        }

        return $this->total_current_year;
    }

    /**
     * Return the years data for each child, first year to now, this is useful for
     * select menus
     *
     * @return array
     */
    public function years(): array
    {
        $years = [];

        for ($i = intval(date('Y')); $i >= $this->first_year; $i--) {
            $years[$i] = [
                'id' => $i,
                'name' => $i
            ];
        }

        return $years;
    }
}
