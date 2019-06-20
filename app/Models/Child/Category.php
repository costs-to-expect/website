<?php
declare(strict_types=1);

namespace App\Models\Child;

use App\Models\Child\Category\Essential;

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
                $model = new Essential();
                break;

            case trans('web/categories.hobby-interest-uri-slug'):
                $model = new Essential();
                break;

            default:
                $model = new Essential();
                break;
        }

        return $model;
    }
}
