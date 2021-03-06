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
        $jack_model = new Jack();
        $niall_model = new Niall();
        $expense_model = new Expense();

        $jack_total = $jack_model->total();
        $niall_total = $niall_model->total();

        $jack_current_year = $jack_model->totalCurrentYear();
        $niall_current_year = $niall_model->totalCurrentYear();

        $recent_expenses = $expense_model->recentExpensesForBothChildren();

        return view(
            'dashboard',
            [
                'menus' => $this->menus(),
                'active' => '/',
                'meta' => [
                    'title' => null,
                    'description' => 'What does it cost to raise a child to adulthood in the UK?'
                ],
                'welcome' => [
                    'title' => 'The cost of raising a child?',
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
