<?php
declare(strict_types=1);

namespace App\Models\Child;

/**
 * @package App\Models\Child
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Subcategory
{
    protected $subcategory = null;
    protected $subcategory_response = null;
    protected $subcategory_populated = false;

    /**
     * Check to see if we have previously called the related method within the
     * request, if we have, the data will already be populated and we can
     * return the requested data without an expensive API call.
     *
     * @return bool
     */
    public function subcategoryPopulated(): bool
    {
        return $this->subcategory_populated;
    }

    public function setSubcategoryApiResponse(?array $response)
    {
        if ($response !== null) {
            $this->subcategory_response = $response;
        }
    }

    /**
     * Return the subcategory details
     *
     * @return array|null
     */
    public function subcategory(): ?array
    {
        if ($this->subcategory_populated === false) {
            if ($this->subcategory_response !== null) {
                $this->subcategory = $this->subcategory_response;

                $this->subcategory_populated = true;
            }
        }

        return $this->subcategory;
    }
}
