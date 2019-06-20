<?php
declare(strict_types=1);

namespace App\Models\Child\Category;

/**
 * @package App\Models\Child
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Essential
{
    public function __construct()
    {
        $this->id = '';
        $this->name = '';
        $this->description = '';
        $this->uri_slug = '';
    }

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
     * Return the base category detail for the given uri slug
     *
     * @param string $uri
     *
     * @return array Three indexes, id, name and description
     */
    public function categoryByUri(string $uri): array
    {
        switch($uri)
        {
            case 'non-essential':
                $category = [
                    'id' => $this->nonEssentialId(),
                    'name' => trans('web/categories.non-essential-name'),
                    'description' => trans('web/categories.non-essential-description'),
                ];
                break;

            case 'hobbies-and-interests':
                $category = [
                    'id' => $this->essentialId(),
                    'name' => trans('web/categories.essential-name'),
                    'description' => trans('web/categories.essential-description'),
                ];
                break;

            default:
                $category = [
                    'id' => $this->essentialId(),
                    'name' => trans('web/categories.hobby-interest-name'),
                    'description' => trans('web/categories.hobby-interest-description'),
                ];
                break;
        }

        return $category;
    }
}
