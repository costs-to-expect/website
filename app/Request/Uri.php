<?php

namespace App\Request;

/**
 * Helper class to generate the URIs for connecting the API
 *
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Uri
{
    private static $resource_type = 'd185Q15grY';

    /**
     * @param string $child_id
     * @return string
     */
    public static function summaryExpenses(string $child_id): string
    {
        return '/v1/summary/resource-types/' . self::$resource_type .
            '/resources/' . $child_id . '/items';
    }

    /**
     * @param string $child_id
     * @return string
     */
    public static function summaryExpensesByCategory(string $child_id): string
    {
        return '/v1/summary/resource-types/' . self::$resource_type .
            '/resources/' . $child_id . '/items?categories=true';
    }

    /**
     * @param string $child_id
     * @return string
     */
    public static function summaryExpensesAnnual(string $child_id): string
    {
        return '/v1/summary/resource-types/' . self::$resource_type .
            '/resources/' . $child_id . '/items?years=true';
    }

    /**
     * @param string $child_id
     * @param integer $limit
     * @param boolean $include_categories
     * @param boolean $include_subcategories
     *
     * @return string
     */
    public static function recentExpenses(
        string $child_id,
        int $limit = 25,
        bool $include_categories = false,
        bool $include_subcategories = false
    ): string
    {
        $uri = '/v1/resource-types/' . self::$resource_type . '/resources/' .
            $child_id . '/items?limit=' . $limit;

        if ($include_categories === true) {
            $uri .= '&include-categories=true';
        }

        if ($include_subcategories === true) {
            $uri .= '&include-subcategories=true';
        }

        return $uri;
    }

    /**
     * @param string $child_id
     * @param string $category_id
     *
     * @return string
     */
    public static function largestExpenseInCategory(
        string $child_id,
        string $category_id): string
    {
        $uri = '/v1/resource-types/' . self::$resource_type . '/resources/' .
            $child_id . '/items?category='. $category_id .
            '&sort=actualised_total:desc&limit=1';

        return $uri;
    }
}
