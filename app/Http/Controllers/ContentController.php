<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
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
            [
                'menus' => $this->menus(),
                'active' => '/about',
                'meta' => [
                    'title' => 'About',
                    'description' => 'What is Costs to Expect.com? Why does it exist and what will the service do?'
                ],
                'welcome' => [
                    'title' => 'About',
                    'description' => 'So, what is Costs to Expect.com?',
                    'image' => [
                        'icon' => 'info.png',
                        'title' => 'About Costs to Expect.com'
                    ]
                ]
            ]
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
            [
                'config' => $this->configProperties(),
                'menus' => $this->menus(),
                'active' => '/what-we-count'
            ]
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
            [
                'config' => $this->configProperties(),
                'menus' => $this->menus(),
                'active' => '/changelog'
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
}
