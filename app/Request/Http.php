<?php

namespace App\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\RequestOptions;
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
     * Silently log an error to the API
     *
     * @param string $method
     * @param integer $expected_status_code
     * @param integer $returned_status_code
     * @param string $requested_uri
     * @param string $debug Optional debug information
     *
     * @return null
     */
    protected static function logApiError(
        string $method,
        int $expected_status_code,
        int $returned_status_code,
        string $requested_uri,
        array $debug = []
    )
    {
        try {
            $response = self::$client->post(
                '/v2/request/error-log',
                [
                    RequestOptions::JSON => [
                        'method' => $method,
                        'expected_status_code' => $expected_status_code,
                        'returned_status_code' => $returned_status_code,
                        'request_uri' => $requested_uri,
                        'source' => 'website',
                        'debug' => implode(':', $debug)
                    ]
                ]
            );
        } catch (\Exception $e) {
            // Nothing yet
            return null;
        }
    }

    /**
     * Make a GET request to the API
     *
     * @param string $uri The URI we want to call
     * @param boolean $headers Store the headers so they can be fetched later
     * @param array $debug Optional debug data
     *
     * @return mixed
     */
    public static function get(string $uri, bool $headers = false, array $debug = []): ?array
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
                self::getInstance()->public()->logApiError(
                    'GET',
                    200,
                    self::$status_code,
                    $uri,
                    array_merge(['GET'], $debug)
                );

                return null;
            }
        } catch (ConnectException $e) {
            abort(503, 'There was an error connecting to the Costs to Expect API.');
        } catch (ClientException $e) {
            abort(400, 'There was an error interpreting the response from the Costs to Expect API.');
        } catch(\Exception $e) {
            abort(500, 'Unexpected error, please be patient whilst we fix it.');
        }

        return $content;
    }

    /**
     * Make a HEAD request to the API
     *
     * @param string $uri The URI we want to call
     * @param array $debug Optional debug data
     *
     * @return mixed
     */
    public static function head(string $uri, array $debug = []): ?array
    {
        try {
            $response = self::$client->head($uri, ['http_errors' => false]);

            self::$status_code = $response->getStatusCode();

            if (self::$status_code === 200) {
                return $response->getHeaders();
            } else {
                self::getInstance()->public()->logApiError(
                    'GET',
                    200,
                    self::$status_code,
                    $uri,
                    array_merge(['HEAD'], $debug)
                );

                return null;
            }
        } catch (ConnectException $e) {
            abort(503, 'There was an error connecting to the Costs to Expect API.');
        } catch (ClientException $e) {
            abort(400, 'There was an error interpreting the response from the Costs to Expect API.');
        } catch(\Exception $e) {
            abort(500, 'Unexpected error, please be patient whilst we fix it.');
        }
    }

    /**
     * Return the headers array for the previous API request
     *
     * @return array|null
     */
    public static function previousRequestHeaders(): array
    {
        return self::$headers ?? [];
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
