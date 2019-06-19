<?php
declare(strict_types=1);

namespace App\Models;

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

    protected $total = null;
    protected $total_response = null;
    protected $total_populated = false;

    protected $total_current_year = null;
    protected $total_current_year_response = null;
    protected $total_current_year_populated = false;

    public function details(): array
    {
        return [
            'version' => $this->version,
            'name' => $this->name,
            'dob' => $this->dob,
            'sex' => $this->sex,
            'weight' => $this->weight,
            'short_name' => $this->short_name,
            'image_uri' => $this->image_uri
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

    /**
     * Check to see if we have previously called the related method within the
     * request, if we have, the data will already be populated and we can
     * return the requested data without an expensive API call.
     *
     * @return bool
     */
    public function totalPopulated(): bool
    {
        return $this->total_populated;
    }

    public function setTotalApiResponse(?array $response)
    {
        if ($response !== null) {
            $this->total_response = $response;
        }
    }

    protected function setTotalData()
    {
        if ($this->total === null) {
            $this->total = [
                'name' => $this->name,
                'dob' => $this->dob,
                'total' => 0.00
            ];
        }
    }

    /**
     * Return the total for the requested child
     *
     * @return array
     */
    public function total(): array
    {
        if ($this->total_populated === false) {
            $this->setTotalData();

            if ($this->total_response !== null && array_key_exists('total', $this->total_response) === true) {
                $this->total['total'] = $this->total_response['total'];

                $this->total_populated = true;
            }
        }

        return $this->total;
    }

    /**
     * Check to see if we have previously called the related method within the
     * request, if we have, the data will already be populated and we can
     * return the requested data without an expensive API call.
     *
     * @return bool
     */
    public function totalCurrentYearPopulated(): bool
    {
        return $this->total_current_year_populated;
    }

    public function setTotalCurrentYearApiResponse(?array $response)
    {
        if ($response !== null) {
            $this->total_current_year_response = $response;
        }
    }

    protected function setTotalCurrentYearData()
    {
        if ($this->total_current_year === null) {
            $this->total_current_year = 0.00;
        }
    }

    /**
     * Return the total for the requested child and the current year
     *
     * @return float|null
     */
    public function totalCurrentYear(): ?float
    {
        if ($this->total_current_year_populated === false) {
            $this->setTotalCurrentYearData();

            if ($this->total_current_year_response !== null && array_key_exists('total', $this->total_current_year_response) === true) {
                $this->total_current_year = (float) $this->total_current_year_response['total'];

                $this->total_current_year_populated = true;
            }
        }

        return $this->total_current_year;
    }
}
