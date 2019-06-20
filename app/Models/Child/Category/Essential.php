<?php
declare(strict_types=1);

namespace App\Models\Child\Category;

use App\Models\Child\Category;

/**
 * @package App\Models\Child
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Essential extends Category
{
    public function __construct()
    {
        $this->id = trans('web/categories.essential-id');
        $this->name = trans('web/categories.essential-name');
        $this->description = trans('web/categories.essential-description');
        $this->uri_slug = trans('web/categories.essential-uri-slug');
    }
}
