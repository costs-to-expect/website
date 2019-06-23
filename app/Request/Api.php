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
     * @var string
     */
    private static $uri;
    /**
     * @var array
     */
    private static $uris;

    public static function resetCalledURIs()
    {
        self::$uris = [];
    }

    public static function calledURIs()
    {
        return self::$uris;
    }

    public static function setCalledURI($name, $uri)
    {
        self::$uris[] = [
            'name' => $name,
            'uri' => $uri
        ];
    }

    public static function lastUri(): string
    {
        return self::$uri;
    }

    /**
     * @param string $child_id
     *
     * @return array|null
     */
    public static function summaryExpenses(string $child_id): ?array
    {
        self::$uri = Uri::summaryExpenses($child_id);

        $response = Http::getInstance()
            ->public()
            ->get(self::$uri);

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
        self::$uri = Uri::summaryExpensesForCurrentYear($child_id);

        $response = Http::getInstance()
            ->public()
            ->get(self::$uri);

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
    public static function summaryExpensesGroupByCategory(string $child_id): ?array
    {
        self::$uri = Uri::summaryExpensesGroupByCategory($child_id);

        $response = Http::getInstance()
            ->public()
            ->get(self::$uri);

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
    public static function summaryExpensesGroupBySubcategory(
        string $child_id,
        string $category_id
    ): ?array
    {
        self::$uri = Uri::summaryExpensesGroupBySubcategory($child_id, $category_id);

        $response = Http::getInstance()
            ->public()
            ->get(self::$uri);

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
        self::$uri = Uri::summaryExpensesAnnual($child_id);

        $response = Http::getInstance()
            ->public()
            ->get(self::$uri);

        if ($response !== null) {
            return $response;
        } else {
            return null;
        }
    }

    /**
     * @param string $child_id
     * @param integer $year
     *
     * @return array|null
     */
    public static function summaryExpensesMonthly(string $child_id, int $year): ?array
    {
        self::$uri = Uri::summaryExpensesMonthly($child_id, $year);

        $response = Http::getInstance()
            ->public()
            ->get(self::$uri);

        if ($response !== null) {
            return $response;
        } else {
            return null;
        }
    }

    /**
     * @return array|null
     */
    public static function recentExpensesForBothChildren(): ?array
    {
        self::$uri = Uri::recentExpensesForBothChildren(
            25,
            true,
            true
        );

        $response = Http::getInstance()
            ->public()
            ->get(self::$uri, true);

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
        self::$uri = Uri::recentExpenses(
            $child_id,
            25,
            true,
            true
        );

        $response = Http::getInstance()
            ->public()
            ->get(self::$uri, true);

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
    public static function recentExpensesByCategory(
        string $child_id,
        string $category_id
    ): ?array
    {
        self::$uri = Uri::recentExpensesByCategory(
            $child_id,
            $category_id,
            25,
            true,
            true
        );

        $response = Http::getInstance()
            ->public()
            ->get(self::$uri, true);

        if ($response !== null) {
            return $response;
        } else {
            return null;
        }
    }

    /**
     * @param string $child_id
     * @param string $category_id
     * @param string $subcategory_id
     *
     * @return array|null
     */
    public static function recentExpensesBySubcategory(
        string $child_id,
        string $category_id,
        string $subcategory_id
    ): ?array
    {
        self::$uri = Uri::recentExpensesBySubcategory(
            $child_id,
            $category_id,
            $subcategory_id,
            25,
            true,
            true
        );

        $response = Http::getInstance()
            ->public()
            ->get(self::$uri, true);

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
        self::$uri = Uri::largestExpenseInCategory($child_id, $category_id);

        $response = Http::getInstance()
            ->public()
            ->get(self::$uri);

        if ($response !== null) {
            return $response;
        } else {
            return null;
        }
    }

    /**
     * @param string $category_id
     * @param string $subcategory_id
     *
     * @return array|null
     */
    public static function subcategory(string $category_id, string $subcategory_id): ?array
    {
        self::$uri = Uri::subcategory($category_id, $subcategory_id);

        $response = Http::getInstance()
            ->public()
            ->get(self::$uri);

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
