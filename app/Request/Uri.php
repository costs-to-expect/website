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
    public static function summaryChildCategories(string $child_id): string
    {
        return '/v1/summary/resource-types/' . self::$resource_type .
            '/resources/' . $child_id . '/items?categories=true';
    }
}
