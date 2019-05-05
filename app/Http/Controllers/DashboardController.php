<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;

/**
 * Site dashboard
 *
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class DashboardController extends BaseController
{
    /**
     * About content page
     *
     * @return View
     */
    public function index(): View
    {
        return view(
            'dashboard',
            [
                'config' => $this->configProperties(),
                'menus' => $this->menus(),
                'active' => '/'
            ]
        );
    }

    /**
     * Return the config properties
     *
     * @return array
     */
    private function configProperties(): array
    {
        return Config::get('web.app');
    }

    /**
     * Return the menus
     *
     * @return array
     */
    private function menus(): array
    {
        return Config::get('web.menus');
    }
}
