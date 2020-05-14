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

    public static function setCalledURI($name, $uri, $method = 'GET')
    {
        self::$uris[] = [
            'name' => $name,
            'uri' => $uri,
            'method' => $method
        ];
    }

    public static function lastUri(): string
    {
        return self::$uri;
    }

    /**
     * HEAD request to the expenses endpoint
     *
     * @param string $child_id
     *
     * @return array|null
     */
    public static function expensesHead(string $child_id): ?array
    {
        self::$uri = Uri::expenses($child_id, 0, 1);

        $response = Http::getInstance()
            ->public()
            ->head(self::$uri);

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
    public static function summaryExpenses(string $child_id): ?array
    {
        self::$uri = Uri::summaryExpenses($child_id);

        return self::cacheableGetRequest(self::$uri);
    }

    /**
     * @param string $child_id
     *
     * @return array|null
     */
    public static function summaryExpensesForCurrentYear(string $child_id): ?array
    {
        self::$uri = Uri::summaryExpensesForCurrentYear($child_id);

        return self::cacheableGetRequest(self::$uri);
    }

    /**
     * @param string $child_id
     *
     * @return array|null
     */
    public static function summaryExpensesGroupByCategory(string $child_id): ?array
    {
        self::$uri = Uri::summaryExpensesGroupByCategory($child_id);

        return self::cacheableGetRequest(self::$uri);
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

        return self::cacheableGetRequest(self::$uri);
    }

    /**
     * @param string $child_id
     *
     * @return array|null
     */
    public static function summaryExpensesAnnual(string $child_id): ?array
    {
        self::$uri = Uri::summaryExpensesAnnual($child_id);

        return self::cacheableGetRequest(self::$uri);
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

        return self::cacheableGetRequest(self::$uri);
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

        return self::cacheableGetRequest(self::$uri);
    }

    /**
     * @param string $child_id
     * @param integer $offset
     * @param integer $limit
     * @param string|null $category
     * @param string|null $subcategory
     * @param integer|null $year
     * @param integer|null $month
     * @param string|null $term
     *
     * @return array|null
     */
    public static function expenses(
        string $child_id,
        int $offset,
        int $limit,
        string $category = null,
        string $subcategory = null,
        int $year = null,
        int $month = null,
        string $term = null
    ): ?array
    {
        self::$uri = Uri::expenses(
            $child_id,
            $offset,
            $limit,
            $category,
            $subcategory,
            $year,
            $month,
            $term,
            true,
            true
        );

        return self::cacheableGetRequest(self::$uri);
    }

    /**
     * @param string $child_id
     * @param string|null $category
     * @param string|null $subcategory
     * @param integer|null $year
     * @param integer|null $month
     * @param string|null $term
     *
     * @return array|null
     */
    public static function expensesSummary(
        string $child_id,
        string $category = null,
        string $subcategory = null,
        int $year = null,
        int $month = null,
        string $term = null
    ): ?array
    {
        self::$uri = Uri::expensesSummary(
            $child_id,
            $category,
            $subcategory,
            $year,
            $month,
            $term
        );

        return self::cacheableGetRequest(self::$uri);
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

        return self::cacheableGetRequest(self::$uri);
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

        return self::cacheableGetRequest(self::$uri);
    }

    /**
     * @param string $child_id
     * @param integer $year
     *
     * @return array|null
     */
    public static function recentExpensesByYear(
        string $child_id,
        int $year
    ): ?array
    {
        self::$uri = Uri::recentExpensesByYear(
            $child_id,
            $year,
            25,
            true,
            true
        );

        return self::cacheableGetRequest(self::$uri);
    }

    /**
     * @param string $child_id
     * @param integer $year
     * @param integer $month
     *
     * @return array|null
     */
    public static function recentExpensesByMonth(
        string $child_id,
        int $year,
        int $month
    ): ?array
    {
        self::$uri = Uri::recentExpensesByMonth(
            $child_id,
            $year,
            $month,
            25,
            true,
            true
        );

        return self::cacheableGetRequest(self::$uri);
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

        return self::cacheableGetRequest(self::$uri);
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

        return self::cacheableGetRequest(self::$uri);
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

        return self::cacheableGetRequest(self::$uri);
    }

    /**
     * @param string $category_id
     *
     * @return array|null
     */
    public static function subcategories(string $category_id): ?array
    {
        self::$uri = Uri::subcategories($category_id);

        return self::cacheableGetRequest(self::$uri);
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

    /**
     * Execute a GET request against the API, check the cache first, store the
     * results in the cache if we end up making a request
     *
     * @param string $uri
     *
     * @return array|null
     */
    private static function cacheableGetRequest(string $uri): ?array
    {
        $cache = new Cache('api');
        $cached = $cache->get($uri);

        if ($cached === null) {
            $response = Http::getInstance()
                ->public()
                ->get($uri, true, [__CLASS__, __METHOD__]);

            if ($response !== null) {
                $cache->put($uri, $response);
                return $response;
            }

            return null;
        } else {
            return $cached;
        }
    }
}
