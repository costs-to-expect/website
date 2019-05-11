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
                'menus' => $this->menus(),
                'active' => '/what-we-count',
                'meta' => [
                    'title' => 'What do we count',
                    'description' => 'How do we come to the totals? What is and isn\'t include in the expenses.'
                ],
                'welcome' => [
                    'title' => 'What we count?',
                    'description' => 'How do we arrive at the figures?',
                    'image' => [
                        'icon' => 'info.png',
                        'title' => 'What do we count'
                    ]
                ]
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
                'menus' => $this->menus(),
                'active' => '/changelog',
                'meta' => [
                    'title' => 'Changelog',
                    'description' => 'The changelog for Costs to Expect.com, as complete as possible'
                ],
                'welcome' => [
                    'title' => 'Changelog',
                    'description' => 'Have there been any updates to the website?',
                    'image' => [
                        'icon' => 'info.png',
                        'title' => 'Changelog'
                    ]
                ]
            ]
        );
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
