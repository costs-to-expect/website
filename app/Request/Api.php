<?php

namespace App\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Request helper class for calling the Costs to Expect API
 *
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Api
{
    /**
     * @var \GuzzleHttp\Client
     */
    private static $client = null;

    /**
     * @var Api
     */
    private static $instance;

    /**
     * @var array The headers for the request.
     */
    private static $headers = null;

    /**
     * Generate a new instance of the helper ot return the existing instance
     *
     * @return Api
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
     * @return Api
     */
    public static function public(): Api
    {
        self::$client = new Client([
            'base_uri' => 'https://api.costs-to-expect.com',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-Source' => 'website'
            ],
        ]);

        return new static();
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
            $response = self::$client->get($uri);

            if ($response->getStatusCode() === 200) {
                $content = json_decode($response->getBody(), true);
                self::$headers = $response->getHeaders();
            } else {
                // Nothing yet
                return null;
            }
        } catch (ClientException $e) {
            // Nothing yet
            return null;
        }

        return $content;
    }

    public static function previousRequestHeaders(): ?array
    {
        return self::$headers;
    }
}
