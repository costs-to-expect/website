<?php
declare(strict_types=1);

namespace App\Models\Child\Category;

use App\Models\Child\Category;

/**
 * @package App\Models\Child
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class HobbyInterest extends Category
{
    public function __construct()
    {
        $this->id = trans('web/categories.hobby-interest-id');
        $this->name = trans('web/categories.hobby-interest-name');
        $this->description = trans('web/categories.hobby-interest-description');
        $this->uri_slug = trans('web/categories.hobby-interest-uri-slug');
    }
}
