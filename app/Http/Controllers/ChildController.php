<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;

/**
 * Child controller
 *
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class ChildController extends BaseController
{
    /**
     * Dashboard for Jack
     *
     * @return View
     */
    public function jack(): View
    {
        return view(
            'jack',
            [
                'config' => $this->configProperties(),
                'menus' => $this->menus(),
                'active' => '/jack'
            ]
        );
    }

    /**
     * Dashboard for Niall
     *
     * @return View
     */
    public function niall(): View
    {
        return view(
            'niall',
            [
                'config' => $this->configProperties(),
                'menus' => $this->menus(),
                'active' => '/niall'
            ]
        );
    }

    /**
     * Years dashboard for Jack
     *
     * @return View
     */
    public function yearsForJack(): View
    {
        return view(
            'jack-years',
            [
                'config' => $this->configProperties(),
                'menus' => $this->menus(),
                'active' => '/jack'
            ]
        );
    }

    /**
     * Years dashboard for Niall
     *
     * @return View
     */
    public function yearsForNiall(): View
    {
        return view(
            'niall-years',
            [
                'config' => $this->configProperties(),
                'menus' => $this->menus(),
                'active' => '/niall'
            ]
        );
    }

    /**
     * Return the config properties
     *
     * @return array
     */
    private function configProperties()
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

    /**
     * Return the API requests for the dashboard
     *
     * @return array
     */
    private function apiRequestsForJack(): array
    {
        return [
            [
                'name' => 'Expenses by category',
                'uri' => '/summary/resource-types/d185Q15grY/resources/kw8gLq31VB/items?categories=true'
            ],
            [
                'name' => 'Expenses by year',
                'uri' => '/summary/resource-types/d185Q15grY/resources/kw8gLq31VB/items?years=true'
            ],
            [
                'name' => '25 most recent expenses',
                'uri' => '/resource-types/d185Q15grY/resources/kw8gLq31VB/items?limit=25&include-categories=true&include-subcategories=true'
            ]
        ];
    }
}
