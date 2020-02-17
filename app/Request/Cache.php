<?php

declare(strict_types=1);

namespace App\Request;

use Illuminate\Support\Facades\Cache as LaravelCache;

/**
 * Cache helper class for requests
 *
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Cache
{
    private $prefix = null;

    private $ttl = 14400;

    public function __construct($cache_prefix)
    {
        $this->prefix = '-' . $cache_prefix . '-';
    }

    /**
     * Set the cache ttl, affected all cache requests
     *
     * @param integer $ttl TTL in seconds
     */
    public function setTtl(int $ttl)
    {
        $this->ttl = $ttl;
    }

    /**
     * Return the cache ttl, defaults to 600 unless changed
     *
     * @return integer
     */
    public function ttl(): int
    {
        return $this->ttl;
    }

    /**
     * Do we have a cached value for the requested index. The index is the
     * prefix and then the suffix, the prefix includes the user id.
     *
     * @param string $suffix Cache suffix
     *
     * @return array|null
     */
    public function get(string $suffix): ?array
    {
        return LaravelCache::get($this->prefix . $suffix);
    }

    /**
     * Store a new item in cache
     *
     * @param string $suffix Cache suffix
     * @param array $data The data to cache
     */
    public function put(string $suffix, array $data)
    {
        LaravelCache::put($this->prefix . $suffix, $data, $this->ttl);
    }

    /**
     * Clear a cached item
     *
     * @param string $suffix
     */
    public function clear(string $suffix)
    {
        LaravelCache::forget($this->prefix . $suffix);
    }
}
