<?php
declare(strict_types=1);

namespace App\Models\Child\Category;

use App\Models\Child\Category;

/**
 * @package App\Models\Child
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class NonEssential extends Category
{
    public function __construct()
    {
        $this->id = trans('web/categories.non-essential-id');
        $this->name = trans('web/categories.non-essential-name');
        $this->description = trans('web/categories.non-essential-description');
        $this->uri_slug = trans('web/categories.non-essential-uri-slug');
    }
}
