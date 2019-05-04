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
                'config' => $this->configProperties()
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
                'config' => $this->configProperties()
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
                'config' => $this->configProperties()
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
                'config' => $this->configProperties()
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
}
