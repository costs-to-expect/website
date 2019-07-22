<?php

namespace App\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Config;

/**
 * Http request helper class
 *
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Http
{
    /**
     * @var \GuzzleHttp\Client
     */
    private static $client = null;

    /**
     * @var Http
     */
    private static $instance;

    /**
     * @var array The headers for the previous request.
     */
    private static $headers = null;

    /**
     * @var int The response code for the previous request
     */
    private static $status_code = null;

    /**
     * Generate a new instance of the helper ot return the existing instance
     *
     * @return Http
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * Set up a public connection to the Costs to Expect API
     *
     * @return Http
     */
    public static function public(): Http
    {
        self::$client = new Client([
            'base_uri' => 'https://api.costs-to-expect.com',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-Source' => Config::get('web.app.api-source')
            ],
        ]);

        return self::$instance;
    }

    /**
     * Make a GET request to the API
     *
     * @param string $uri The URI we want to call
     * @param boolean $headers Store the headers so they can be fetched later
     *
     * @return mixed
     */
    public static function get(string $uri, $headers = false): ?array
    {
        $content = null;

        try {
            $response = self::$client->get($uri, ['http_errors' => false]);

            self::$status_code = $response->getStatusCode();

            if (self::$status_code === 200) {
                $content = json_decode($response->getBody(), true);
                if ($headers == true) {
                    self::$headers = $response->getHeaders();
                }
            } else {
                // Nothing yet, this is where we log API errors as long as we didn't get a 503.
                return null;
            }
        } catch (ClientException $e) {
            // Nothing yet
            return null;
        }

        return $content;
    }

    /**
     * Make a HEAD request to the API
     *
     * @param string $uri The URI we want to call
     *
     * @return mixed
     */
    public static function head(string $uri): ?array
    {
        try {
            $response = self::$client->head($uri, ['http_errors' => false]);

            self::$status_code = $response->getStatusCode();

            if (self::$status_code === 200) {
                return $response->getHeaders();
            } else {
                // Nothing yet, this is where we log API errors as long as we didn't get a 503.
                return null;
            }
        } catch (ClientException $e) {
            // Nothing yet
            return null;
        }
    }

    /**
     * Return the headers array for the previous API request
     *
     * @return array|null
     */
    public static function previousRequestHeaders(): array
    {
        return (self::$headers !== null) ? self::$headers : [];
    }

    /**
     * Return the status code for the previous API request
     *
     * @return int|null
     */
    public static function previousRequestStatusCode(): ?int
    {
        return self::$status_code;
    }
}
