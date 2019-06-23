<?php
declare(strict_types=1);

namespace App\Models\Child;

use App\Request\Api;

/**
 * @package App\Models\Child
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Subcategory
{
    protected $subcategory = null;
    protected $subcategory_populated = false;

    /**
     * Fetch the details for the requested subcategory
     *
     * Subsequent calls of this method will not execute an expense API call if
     * called within the same request
     *
     * @param string $category_id
     * @param string $subcategory_id
     *
     * @return array|null
     */
    public function subcategory(string $category_id, string $subcategory_id): ?array
    {
        if ($this->subcategory_populated === false) {
            $response = Api::subcategory(
                $category_id,
                $subcategory_id
            );
            Api::setCalledURI('Subcategory details', Api::lastUri());
            if ($response !== null) {
                $this->subcategory = $response;
                $this->subcategory_populated = true;
            } else {
                $this->subcategory = null;
            }
        }

        return $this->subcategory;
    }
}
