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
    /**
     * @param string $child_id
     *
     * @return array|null
     */
    public static function summaryExpenses(string $child_id): ?array
    {
        $response = Http::getInstance()
            ->public()
            ->get(Uri::summaryExpenses($child_id));

        if ($response !== null) {
            return $response;
        } else {
            return null;
        }
    }

    /**
     * @param string $child_id
     *
     * @return array|null
     */
    public static function summaryExpensesForCurrentYear(string $child_id): ?array
    {
        $response = Http::getInstance()
            ->public()
            ->get(Uri::summaryExpensesForCurrentYear($child_id));

        if ($response !== null) {
            return $response;
        } else {
            return null;
        }
    }

    /**
     * @param string $child_id
     *
     * @return array|null
     */
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

    /**
     * @param string $child_id
     *
     * @return array|null
     */
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

    /**
     * @param string $child_id
     *
     * @return array|null
     */
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
     * @param string $child_id
     * @param string $category_id
     *
     * @return array|null
     */
    public static function largestExpenseInCategory(
        string $child_id,
        string $category_id
    ): ?array
    {
        $response = Http::getInstance()
            ->public()
            ->get(Uri::largestExpenseInCategory($child_id, $category_id));

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
