<?php

namespace App\Http\Controllers;

use App\Models\Child\Expense;
use App\Models\Child\Jack;
use App\Models\Child\Niall;
use App\Request\Api;
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
     * Site welcome dashboard
     *
     * @return View
     */
    public function index(): View
    {
        Api::resetCalledURIs();
        $jack = new Jack();
        $niall = new Niall();
        $expenses = new Expense();

        $jack_total = $jack->total();
        $niall_total = $niall->total();

        $jack_current_year = $jack->totalCurrentYear();
        $niall_current_year = $niall->totalCurrentYear();

        $recent_expenses = $expenses->recentExpensesForBothChildren();

        return view(
            'dashboard',
            [
                'menus' => $this->menus(),
                'active' => '/',
                'meta' => [
                    'title' => 'Dashboard',
                    'description' => 'What does it cost to raise a child to adulthood in the UK?'
                ],
                'welcome' => [
                    'title' => 'Cost to raise a child?',
                    'description' => 'Welcome to Costs to Expect.com',
                    'image' => [
                        'icon' => 'dashboard.png',
                        'title' => 'Costs to Expect.com'
                    ]
                ],
                'jack_total' => $jack_total,
                'niall_total' => $niall_total,
                'recent_expenses' => $recent_expenses,
                'jack_current_year' => $jack_current_year,
                'niall_current_year' => $niall_current_year,
                'api_requests' => Api::calledURIs()
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
