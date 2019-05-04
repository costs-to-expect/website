<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;

/**
 * Simple content pages
 *
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class ContentController extends BaseController
{
    /**
     * About content page
     *
     * @return View
     */
    public function about(): View
    {
        return view(
            'about',
            []
        );
    }

    /**
     * What we count content page
     *
     * @return View
     */
    public function whatWeCount(): View
    {
        return view(
            'what-we-count',
            []
        );
    }

    /**
     * Changelog
     *
     * @return View
     */
    public function changelog(): View
    {
        return view(
            'changelog',
            []
        );
    }
}
