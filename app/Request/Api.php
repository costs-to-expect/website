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

    public static function summaryExpensesAnnual(string $child_id): ?array
    {
        $response = Http::getInstance()
            ->public()
            ->get(Uri::summaryExpensesAnnual($child_id));

        if ($response !== null) {
            return $response;
        } else {
            return null;
        }
    }

    public static function recentExpenses(string $child_id): ?array
    {
        $response = Http::getInstance()
            ->public()
            ->get(
                Uri::recentExpenses(
                    $child_id,
                    25,
                    true,
                    true
                ),
                true
            );

        if ($response !== null) {
            return $response;
        } else {
            return null;
        }
    }

    /**
     * Return the headers array for the previous API request
     *
     * @return array|null
     */
    public static function previousRequestHeaders(): ?array
    {
        return Http::getInstance()->previousRequestHeaders();
    }

    /**
     * Return the status code for the previous API request
     *
     * @return int|null
     */
    public static function previousRequestStatusCode(): ?int
    {
        return Http::getInstance()->previousRequestStatusCode();
    }
}
