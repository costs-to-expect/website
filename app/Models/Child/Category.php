<?php
declare(strict_types=1);

namespace App\Models\Child;

use App\Models\Child\Category\Essential;
use App\Models\Child\Category\HobbyInterest;
use App\Models\Child\Category\NonEssential;
use App\Request\Api;

/**
 * @package App\Models\Child
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Category
{
    protected $id;
    protected $name;
    protected $description;
    protected $uri_slug;

    protected $subcategory_summary = null;
    protected $subcategory_summary_populated = false;

    protected $subcategories = null;
    protected $subcategories_populated = false;

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
     * Return the relevant model by the id
     *
     * @param string $uri
     *
     * @return Category
     */
    public static function modelById(string $uri): Category
    {
        switch($uri)
        {
            case trans('web/categories.non-essential-id'):
                $model = new NonEssential();
                break;

            case trans('web/categories.hobby-interest-id'):
                $model = new HobbyInterest();
                break;

            default:
                $model = new Essential();
                break;
        }

        return $model;
    }

    /**
     * Fetch the subcategory summary for the requested child and category for the requested subcategory
     *
     * Subsequent calls of this method will not execute an expense API call if
     * called within the same request
     *
     * @param string $child_id
     * @param string $category_id
     *
     * @return array|null
     */
    public function subcategorySummary(string $child_id, string $category_id): array
    {
        if ($this->subcategory_summary_populated === false) {
            $response = Api::summaryExpensesGroupBySubcategory(
                $child_id,
                $category_id
            );
            Api::setCalledURI('Expenses summary by subcategory', Api::lastUri());

            if ($response !== null) {
                $this->subcategory_summary = $response;
                $this->subcategory_summary_populated = true;
            } else {
                $this->subcategory_summary = [];
            }
        }

        return $this->subcategory_summary;
    }

    /**
     * Fetch the subcategories for the requested category
     *
     * Subsequent calls of this method will not execute an expensive API call if
     * called within the same request
     *
     * @param string $category_id
     *
     * @return array
     */
    public function subcategories(string $category_id): array
    {
        if ($this->subcategories_populated === false) {
            $response = Api::subcategories($category_id);
            Api::setCalledURI('Subcategories listing', Api::lastUri());

            if ($response !== null) {
                foreach ($response as $subcategory) {
                    $this->subcategories[$subcategory['id']] = $subcategory;
                }
                $this->subcategories_populated = true;
            } else {
                $this->subcategories = [];
            }
        }

        return $this->subcategories;
    }

    /**
     * Return the base category ids, useful for select menus
     *
     * @return array
     */
    public function allCategories()
    {
        return [
            trans('web/categories.essential-id') => [
                'id' => trans('web/categories.essential-id'),
                'name' => trans('web/categories.essential-name')
            ],
            trans('web/categories.non-essential-id') => [
                'id' => trans('web/categories.non-essential-id'),
                'name' => trans('web/categories.non-essential-name')
            ],
            trans('web/categories.hobby-interest-id') => [
                'id' => trans('web/categories.hobby-interest-id'),
                'name' => trans('web/categories.hobby-interest-name')
            ]
        ];
    }
}
