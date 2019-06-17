<?php

namespace App\Request;

/**
 * Helper class to make requests to the Costs to Expect API
 *
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Api
{
    public static function summaryExpensesByCategory(string $child_id): ?array
    {
        $response = Http::getInstance()
            ->public()
            ->get(Uri::summaryExpensesByCategory($child_id));

        if ($response !== null) {
            return $response;
        } else {
            return null;
        }
    }
}
