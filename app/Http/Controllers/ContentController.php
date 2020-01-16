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
                    'description' => 'What does it cost to raise a child to adulthood in the UK?'
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
     * Changelog
     *
     * @return View
     */
    public function privacyPolicy(): View
    {
        return view(
            'privacy-policy',
            [
                'menus' => $this->menus(),
                'active' => '/privacy-policy',
                'meta' => [
                    'title' => 'Privacy policy',
                    'description' => 'The Costs to Expect Privacy policy'
                ],
                'welcome' => [
                    'title' => 'Privacy policy',
                    'description' => 'The Cots to Expect Privacy policy',
                    'image' => [
                        'icon' => 'info.png',
                        'title' => 'Privacy policy'
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
