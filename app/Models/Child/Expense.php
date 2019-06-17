<?php
declare(strict_types=1);

namespace App\Models\Child;

/**
 * @package App\Models
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Expense
{
    public function recentExpenses(?array $api_data)
    {
        $expenses = [];

        if ($api_data !== null) {
            $expenses = $api_data;
        }

        return $expenses;
    }


}
