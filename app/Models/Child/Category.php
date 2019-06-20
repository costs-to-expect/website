<?php
declare(strict_types=1);

namespace App\Models\Child;

use App\Models\Child\Category\Essential;
use App\Models\Child\Category\HobbyInterest;
use App\Models\Child\Category\NonEssential;

/**
 * @package App\Models\Child
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
abstract class Category
{
    protected $id;
    protected $name;
    protected $description;
    protected $uri_slug;

    protected $subcategory_summary = null;
    protected $subcategory_summary_response = null;
    protected $subcategory_summary_populated = false;

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function uriSlug(): string
    {
        return $this->uri_slug;
    }

    /**
     * Return the relevant model by the URI slug
     *
     * @param string $uri
     *
     * @return Category
     */
    public static function modelByUriSlug(string $uri): Category
    {
        switch($uri)
        {
            case trans('web/categories.non-essential-uri-slug'):
                $model = new NonEssential();
                break;

            case trans('web/categories.hobby-interest-uri-slug'):
                $model = new HobbyInterest();
                break;

            default:
                $model = new Essential();
                break;
        }

        return $model;
    }

    /**
     * Check to see if we have previously called the related method within the
     * request, if we have, the data will already be populated and we can
     * return the requested data without an expensive API call.
     *
     * @return bool
     */
    public function subcategorySummaryPopulated(): bool
    {
        return $this->subcategory_summary_populated;
    }

    public function setSubcategorySummaryApiResponse(?array $response)
    {
        if ($response !== null) {
            $this->subcategory_summary_response = $response;
        }
    }

    /**
     * Return the subcategory summary for a child
     *
     * @return array
     */
    public function subcategorySummary(): array
    {
        if ($this->subcategory_summary_populated === false) {
            $this->subcategory_summary = [];

            if ($this->subcategory_summary_response !== null) {
                $this->subcategory_summary = $this->subcategory_summary_response;

                $this->subcategory_summary_populated = true;
            }
        }

        return $this->subcategory_summary;
    }
}
